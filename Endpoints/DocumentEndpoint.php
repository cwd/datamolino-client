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

namespace Cwd\Datamolino\Endpoints;

use Cwd\Datamolino\Model\Document;
use Cwd\Datamolino\Model\DocumentFile;
use Cwd\Datamolino\Model\OriginalFile;
use Cwd\Datamolino\Model\UploadFile;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\File\File as FileInfo;
use Webmozart\Assert\Assert;

class DocumentEndpoint extends AbstractEndpoint
{
    public const PAYLOAD_LIMIT = 1024 * 1024 * 20; // 20MB
    const ENDPOINT = 'documents';

    /**
     * @param string|array|Finder $source    Location of Files or Finder Instance or array of SPLFileInfo
     * @param int                 $agendaId
     * @param string              $type
     * @param bool                $fileSplit
     * @param bool                $lacyLoad
     *
     * @return Document[]
     *
     * @throws \Http\Client\Exception
     * @throws \LogicException
     */
    public function createMultiple($source, int $agendaId, string $type = Document::DOCTYPE_PURCHASE, $fileSplit = false, $lacyLoad = false): array
    {
        $currentFileSize = 0;
        $resultDocuments = [];
        $documentFiles = [];

        $files = $this->retrieveFiles($source);

        foreach ($files as $file) {
            $documentFile = new DocumentFile();
            $documentFile->setType($type)
                ->setAgendaId($agendaId)
                ->setFileSplit($fileSplit);

            $mimeType = (new FileInfo($file->getPathname()))->getMimeType();
            $currentFileSize += $file->getSize();
            $documentFile->setFile(
                new UploadFile($file->getFilename(), $mimeType, file_get_contents($file->getPathname()))
            );

            $documentFiles[] = $documentFile;

            if ($currentFileSize >= self::PAYLOAD_LIMIT) {
                $resultDocuments += $this->send($documentFiles, $lacyLoad);
                $documentFiles = [];
            }
        }

        if (count($documentFiles) > 0) {
            $resultDocuments += $this->send($documentFiles, $lacyLoad);
        }

        return $resultDocuments;
    }

    /**
     * @param string $fileUri
     * @param int    $agendaId
     * @param string $filename
     * @param string $type
     * @param bool   $fileSplit
     * @param bool   $lacyLoad
     *
     * @return Document
     *
     * @throws \Http\Client\Exception
     */
    public function create($fileUri, $agendaId, $filename, $type = Document::DOCTYPE_PURCHASE, $fileSplit = false, $lacyLoad = false): Document
    {
        $file = new FileInfo($fileUri);
        $mimeType = $file->getMimeType();

        $documentFile = new DocumentFile();
        $documentFile->setType($type)
            ->setAgendaId($agendaId)
            ->setFileSplit($fileSplit)
            ->setFile(
                new UploadFile($file->getFilename(), $mimeType, file_get_contents($file->getPathname()))
            )
        ;

        return current($this->send([$documentFile], $lacyLoad));
    }

    /**
     * @param DocumentFile[] $files
     *
     * @return array
     *
     * @throws \Http\Client\Exception
     */
    public function send(array $files, $lacyLoad = true)
    {
        $payload = $this->getClient()->getSerializer()->serialize(['documents' => $files], 'json');
        $documents = $this->getClient()->call($payload, null, self::ENDPOINT, Document::class, true, 'POST');

        if ($lacyLoad) {
            $ids = [];
            /** @var Document $document */
            foreach ($documents as $document) {
                if (null === $document->getId()) {
                    continue;
                }
                $ids[] = $document->getId();
            }

            if (0 == count($ids)) {
                return [];
            }

            return $this->find(current($files)->getAgendaId(), $ids);
        }

        return $documents;
    }

    /**
     * @param int $id
     *
     * @return Document|Document[]
     *
     * @throws \Http\Client\Exception
     */
    public function get(int $id)
    {
        $documents = $this->getClient()->call(null, $id, self::ENDPOINT, Document::class, true, 'GET');

        if (1 == count($documents)) {
            return current($documents);
        }

        return $documents;
    }

    /**
     * @param $document
     *
     * @return OriginalFile
     *
     * @throws \Http\Client\Exception
     */
    public function getOriginalFile($document): OriginalFile
    {
        if ($document instanceof Document) {
            $document = $document->getId();
        }

        return $this->getClient()->call(null, $document, self::ENDPOINT, OriginalFile::class, false, 'GET', '/original_file');
    }

    /**
     * @param int|Document $document
     *
     * @throws \Http\Client\Exception
     */
    public function delete($document): void
    {
        if ($document instanceof Document) {
            $document = $document->getId();
        }

        $this->getClient()->call(null, $document, self::ENDPOINT, null, false, 'DELETE');
    }

    /**
     * @param Document|int $document
     * @param string       $text
     *
     * @throws \Http\Client\Exception
     */
    public function repair($document, $text): void
    {
        if ($document instanceof Document) {
            $document = $document->getId();
        }

        $this->getClient()->call(null, $document, self::ENDPOINT, OriginalFile::class, false, 'POST', sprintf(
                '/repair?repair_description=%s', urlencode($text))
        );
    }

    /**
     * @param int            $agendaId
     * @param array          $ids
     * @param \DateTime|null $modifiedSince
     * @param array          $states
     * @param int            $page
     * @param string         $type
     *
     * @return mixed
     *
     * @throws \Http\Client\Exception
     */
    public function find($agendaId, array $ids = [], ?\DateTime $modifiedSince = null, array $states = [], $page = 1, $type = Document::DOCTYPE_PURCHASE)
    {
        $queryString = [
            sprintf('agenda_id=%s', $agendaId),
            sprintf('page=%s', $page),
            sprintf('type=%s', $type),
        ];

        if (null !== $modifiedSince) {
            $queryString[] = sprintf('modified_since=%s', $modifiedSince->format('Y-m-d\TH:i:s\Z'));
        }

        if (count($states) > 0) {
            foreach ($states as $state) {
                $queryString[] = sprintf('states[]=%s', $state);
            }
        }

        if (count($ids) > 0) {
            foreach ($ids as $id) {
                $queryString[] = sprintf('ids[]=%s', $id);
            }
        }

        return $this->getClient()->call(null, sprintf('?%s', implode('&', $queryString)), self::ENDPOINT, Document::class, true, 'GET');
    }

    /**
     * @param string|array|Finder $filesProvider Location of Files or Finder Instance or array of SPLFileInfo
     *
     * @throws \LogicException
     *
     * @return \SplFileInfo[]
     */
    private function retrieveFiles($filesProvider): iterable
    {
        if ($filesProvider instanceof Finder) {
            return $filesProvider->files();
        }

        if (is_string($filesProvider)) {
            return (new Finder())->in($filesProvider)->files();
        }

        if (is_array($filesProvider)) {
            Assert::allIsInstanceOf($filesProvider, \SplFileInfo::class, 'When using array all files need to implement SPLFileInfo');

            return $filesProvider;
        }

        throw new \LogicException(sprintf('Invalid files provider type: "%s', gettype($filesProvider)));
    }
}
