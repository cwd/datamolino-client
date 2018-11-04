<?php

/*
 * This file is part of datamolino client.
 *
 * (c) 2018 cwd.at GmbH <office@cwd.at>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Cwd\Datamolino;

use Cwd\Datamolino\Model\Token;
use GuzzleHttp\Psr7\Request;
use Http\Client\HttpClient;
use Http\Discovery\HttpClientDiscovery;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use GuzzleHttp\Client as GuzzleClient;

class Client
{
    private $apiUrl = 'https://beta.datamolino.com';
    private $apiVersion = 'v1_2';
    private $apiUri;
    private $tokenUrl;
    /** @var Token */
    private $token;

    /** @var HttpClient */
    private $client;

    /** @var Serializer */
    private $serializer;

    public function __construct(?GuzzleClient $client = null)
    {
        if (null === $client) {
            $this->client = HttpClientDiscovery::find();
        }
        $this->apiUri = sprintf('%s/api/%s/', $this->apiUrl, $this->apiVersion);
        $this->tokenUrl = $this->apiUrl.'/oauth/token';

        $normalizer = new ObjectNormalizer(null, new CamelCaseToSnakeCaseNameConverter(), null, new ReflectionExtractor());
        $this->serializer = new Serializer([new DateTimeNormalizer(), $normalizer], ['json' => new JsonEncoder()]);
    }

    /**
     * @param string|null     $payload
     * @param int|string|null $id
     * @param string          $endpoint
     * @param string|null     $hydrationClass
     * @param bool            $isList
     * @param string          $method
     * @param string|null     $urlExtension   - Special case only needed when retrieving original file!
     *
     * @throws \Http\Client\Exception
     * @throws \LogicException
     *
     * @return mixed
     */
    public function call($payload = null, $id = null, $endpoint = '', $hydrationClass = null, $isList = false, $method = 'POST', $urlExtension = null)
    {
        if (!$this->token instanceof Token) {
            throw new \LogicException('Token not set - Authenticate first - or store refresh token for later use');
        }

        if (in_array($method, ['GET', 'PUT', 'DELETE'])) {
            $format = (is_int($id)) ? '%s%s/%s' : '%s%s%s';
            $uri = sprintf($format, $this->apiUri, $endpoint, $id);
        } else {
            $uri = (null !== $id) ? sprintf('%s%s/%s', $this->apiUri, $endpoint, $id) : $this->apiUri.$endpoint;
        }

        /* Special case only needed for retrieve original file */
        if (null !== $urlExtension) {
            $uri .= $urlExtension;
        }

        $request = new Request($method, $uri, [
            'Authorization' => sprintf('Bearer %s', $this->token->getAccessToken()),
            'Content-Type' => 'application/json',
        ], $payload);

        $response = $this->client->sendRequest($request);
        $responseBody = $response->getBody()->getContents();
        $responseData = json_decode($responseBody);

        dump($responseData);

        if ($response->getStatusCode() >= 300) {
            $message = isset($responseData->message) ?? 'Unknown';
            throw new \Exception(sprintf('Error on request %s: %s', $response->getStatusCode(), $message));
        }

        if (null !== $hydrationClass && class_exists($hydrationClass) && isset($responseData->$endpoint)) {
            return $this->denormalizeObject($hydrationClass, $responseData->$endpoint, $isList);
        } elseif (null !== $hydrationClass && !class_exists($hydrationClass)) {
            throw new \Exception(sprintf('HydrationClass (%s) does not exist', $hydrationClass));
        } elseif (null !== $hydrationClass && !isset($responseData->$endpoint)) {
            throw new \Exception(sprintf('Datapoint (%s) does not exist', $endpoint));
        }

        return $responseData;
    }

    /**
     * @param string $clientId
     * @param string $clientSecret
     * @param string $username
     * @param string $password
     *
     * @throws \Http\Client\Exception
     *
     * @return Token
     */
    public function authenticatePassword($clientId, string $clientSecret, string $username, string $password): Token
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
        $this->token = $this->denormalizeObject(Token::class, [json_decode($responseBody)], false);

        return $this->token;
    }

    /**
     * @param string $clientId
     * @param string $clientSecret
     * @param string $refreshToken
     *
     * @throws \Http\Client\Exception
     *
     * @return Token
     */
    public function refreshToken($clientId, $clientSecret, $refreshToken): Token
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

        $this->token = $this->denormalizeObject(Token::class, [json_decode($responseBody)], false);

        return $this->token;
    }

    public function setToken(Token $token): Client
    {
        $this->token = $token;

        return $this;
    }

    /**
     * @return string
     */
    public function getApiUrl(): string
    {
        return $this->apiUrl;
    }

    /**
     * @param string $apiUrl
     *
     * @return Client
     */
    public function setApiUrl(string $apiUrl): Client
    {
        $this->apiUrl = $apiUrl;

        return $this;
    }

    /**
     * @return string
     */
    public function getApiVersion(): string
    {
        return $this->apiVersion;
    }

    /**
     * @param string $apiVersion
     *
     * @return Client
     */
    public function setApiVersion(string $apiVersion): Client
    {
        $this->apiVersion = $apiVersion;

        return $this;
    }

    /**
     * @return string
     */
    public function getApiUri(): string
    {
        return $this->apiUri;
    }

    /**
     * @param string $apiUri
     *
     * @return Client
     */
    public function setApiUri(string $apiUri): Client
    {
        $this->apiUri = $apiUri;

        return $this;
    }

    /**
     * @return string
     */
    public function getTokenUrl(): string
    {
        return $this->tokenUrl;
    }

    /**
     * @param string $tokenUrl
     *
     * @return Client
     */
    public function setTokenUrl(string $tokenUrl): Client
    {
        $this->tokenUrl = $tokenUrl;

        return $this;
    }

    public function denormalizeObject($hydrationClass, $dataObject, $isList = false)
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

    /**
     * @return Serializer
     */
    public function getSerializer(): Serializer
    {
        return $this->serializer;
    }
}
