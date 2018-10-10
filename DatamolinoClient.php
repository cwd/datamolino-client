<?php
declare(strict_types=1);

namespace Cwd\Datamolino;

use Cwd\Datamolino\Model\Agenda;
use Cwd\Datamolino\Model\Document;
use Cwd\Datamolino\Model\User;
use GuzzleHttp\Psr7\Request;
use Http\Client\HttpClient;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

class DatamolinoClient
{

    private $apiUrl = 'https://beta.datamolino.com';
    private $apiVersion = 'v1_2';
    private $apiUri;
    private $tokenUrl;

    private $token;

    /** @var HttpClient */
    private $client;

    /** @var Serializer  */
    private $serializer;

    public function __construct(HttpClient $client)
    {
        $this->client = $client;
        $this->apiUri = sprintf('%s/api/%s/', $this->apiUrl, $this->apiVersion);
        $this->tokenUrl = $this->apiUrl.'/oauth/token';

        $normalizer = new ObjectNormalizer(null, new CamelCaseToSnakeCaseNameConverter(), null, new ReflectionExtractor());
        $this->serializer = new Serializer([new DateTimeNormalizer(), $normalizer], ['json' => new JsonEncoder()]);
    }

    public function getDocuments($agendaId, ?\DateTime $modifiedSince = null, array $states = [], $page = 1, $type = Document::DOCTYPE_PURCHASE, array $ids = [])
    {
        $queryString = [
            sprintf('agenda_id=%s', $agendaId),
            sprintf('page=%s', $page),
            sprintf('type=%s', $type),
        ];

        if ($modifiedSince !== null) {
            $queryString[] = sprintf('modified_since=%s', $modifiedSince->format('Y-m-d\TH:i:s\Z'));
        }

        if (count($states) > 0) {
            foreach ($states as $state) {
                $queryString[] = sprintf('state[]=%s', $state);
            }
        }

        if (count($ids) > 0) {
            foreach ($ids as $id) {
                $queryString[] = sprintf('ids[]=%s', $id);
            }
        }

        return $this->call(null, sprintf('?%s', implode('&', $queryString)), 'documents', Document::class, true, 'GET');
    }

    /**
     * @return Agenda[]
     * @throws \Http\Client\Exception
     */
    public function getAgendas()
    {
        return $this->call(null, null,'agendas', Agenda::class, true, 'GET');
    }

    /**
     * @param int $id
     * @return Agenda
     * @throws \Http\Client\Exception
     */
    public function getAgenda(int $id): Agenda
    {
        return $this->call(null, $id, 'agendas', Agenda::class, false, 'GET');
    }

    /**
     * @param Agenda $agenda
     * @param bool $lazyLoad if false the agenda object only holds the ID
     * @return Agenda
     * @throws \Http\Client\Exception
     */
    public function createAgenda(Agenda $agenda, $lazyLoad = false): Agenda
    {
        $payload = $this->serializer->serialize(['agendas' => [$agenda]], 'json');
        $agenda = $this->call($payload, null, 'agendas', Agenda::class, false, 'POST');

        if ($lazyLoad) {
            return $this->getAgenda($agenda->getId());
        }

        return $agenda;
    }

    /**
     * @return User
     * @throws \Http\Client\Exception
     */
    public function getMe(): User
    {
        // Result is different - denormalize by hand
        $data = $this->call(null, null, 'me', null, false, 'GET');
        return $this->denormalizeObject(User::class, [$data],false);
    }

    /**
     * @param Agenda $agenda
     * @return void|
     * @throws \Http\Client\Exception
     */
    public function updateAgenda(Agenda $agenda)
    {
        $payload = $this->serializer->serialize(['agendas' => [$agenda]], 'json');
        $this->call($payload, $agenda->getId(),'agendas', null, false, 'PUT');
    }

    /**
     * @param Agenda $agenda
     * @return mixed
     * @throws \Http\Client\Exception
     */
    public function deleteAgenda(int $id): void
    {
        $this->call(null, $id,'agendas', null, false, 'DELETE');
    }

    /**
     * @param string|null $payload
     * @param int|string|null $id
     * @param string $endpoint
     * @param string|null $hydrationClass
     * @param bool $isList
     * @param string $method
     * @return mixed
     * @throws \Http\Client\Exception
     */
    protected function call($payload = null, $id = null, $endpoint = '', $hydrationClass = null, $isList = false, $method = 'POST')
    {
        if ($this->token === null) {
            throw new \Exception('Token not set');
        }

        if (in_array($method, ['GET', 'PUT', 'DELETE'])) {
            $format = (is_int($id)) ? '%s%s/%s' : '%s%s%s';
            $uri = sprintf($format, $this->apiUri, $endpoint, $id);
        } else {
            $uri = $this->apiUri.$endpoint;
        }

        $request = new Request($method, $uri, [
            'Authorization' => sprintf('Bearer %s', $this->token),
            'Content-Type' => 'application/json',
        ], $payload);

        $response = $this->client->sendRequest($request);
        $responseBody = $response->getBody()->getContents();
        $responseData = json_decode($responseBody);

        if ($response->getStatusCode() > 299) {
            $message = isset($responseData->message) ? $responseData->message : 'Unknown';
            throw new \Exception(sprintf('Error on request %s: %s', $response->getStatusCode(), $message));
        }

        if (getenv('APP_ENV') === 'dev') {
            dump($responseData);
        }

        if ($hydrationClass !== null && class_exists($hydrationClass) && isset($responseData->$endpoint)) {
            return $this->denormalizeObject($hydrationClass, $responseData->$endpoint, $isList);
        } elseif ($hydrationClass !== null && !class_exists($hydrationClass)) {
            throw new \Exception(sprintf('HydrationClass (%s) does not exist', $hydrationClass));
        } elseif ($hydrationClass !== null && !isset($responseData->$endpoint)) {
            throw new \Exception(sprintf('Datapoint (%s) does not exist', $endpoint));
        }

        return $responseData;
    }

    /**
     * @param string $clientId
     * @param string $clientSecret
     * @param string $username
     * @param string $password
     * @throws \Http\Client\Exception
     * @ToDo Handle Token storage
     */
    public function authenticatePassword($clientId, $clientSecret, $username, $password)
    {
        $request = new Request('POST', $this->tokenUrl, [
            'Content-Type' => 'application/json',
        ], json_encode([
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
            'username' => $username,
            'password' => $password,
            'grant_type' => 'password',
        ]));

        $response = $this->getClient()->sendRequest($request);
        $responseBody = $response->getBody()->getContents();
        dump($responseBody);
    }

    /**
     * @param string $clientId
     * @param string $clientSecret
     * @param string $refreshToken
     * @throws \Http\Client\Exception
     * @ToDo Handle Token storage
     */
    public function refreshToken($clientId, $clientSecret, $refreshToken)
    {
        $request = new Request('POST', $this->tokenUrl, [
            'Content-Type' => 'application/json',
        ], json_encode([
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
            'refresh_token' => $refreshToken,
            'grant_type' => 'refresh_token',
        ]));

        $response = $this->getClient()->sendRequest($request);
        $responseBody = $response->getBody()->getContents();
        dump($responseBody);
    }

    public function setToken($token): DatamolinoClient
    {
        $this->token = $token;
        return $this;
    }

    protected function denormalizeObject($hydrationClass, $dataObject, $isList = false)
    {
        $result = [];

        foreach ($dataObject as $data) {
            $result[] = $this->serializer->denormalize($data, $hydrationClass, null, [
                ObjectNormalizer::DISABLE_TYPE_ENFORCEMENT => true,
            ]);
        }

        if ($isList) {
            return $result;
        }

        return current($result);
    }

    protected function getClient(): HttpClient
    {
        return $this->client;
    }
}