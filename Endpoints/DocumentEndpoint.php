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

class DocumentEndpoint extends AbstractEndpoint
{
    public const PAYLOAD_LIMIT = 1024 * 1024 * 20; // 20MB

    /**
     * @param string|Finder $finder    Location of Files or Finder Instance
     * @param int           $agendaId
     * @param string        $type
     * @param bool          $fileSplit
     * @param bool          $lacyLoad
     *
     * @return Document[]
     *
     * @throws \Http\Client\Exception
     */
    public function createByFinder($finder, int $agendaId, string $type = Document::DOCTYPE_PURCHASE, $fileSplit = false, $lacyLoad = false): array
    {
        $currentFileSize = 0;
        $resultDocuments = [];
        $documentFiles = [];

        if (!$finder instanceof Finder) {
            $finder = (new Finder())->in($finder);
        }

        foreach ($finder as $file) {
            $documentFile = new DocumentFile();
            $documentFile->setType($type)
                ->setAgendaId($agendaId)
                ->setFileSplit($fileSplit);

            $mimeType = (new FileInfo($file->getPathname()))->getMimeType();
            $currentFileSize += $file->getSize();
            $documentFile->setFile(
                new UploadFile($file->getFilename(), $mimeType, $file->getContents())
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
        $documents = $this->getClient()->call($payload, null, 'documents', Document::class, true, 'POST');

        if ($lacyLoad) {
            $ids = [];
            /** @var Document $document */
            foreach ($documents as $document) {
                $ids[] = $document->getId();
            }

            return $this->find(current($files)->getAgendaId(), $ids);
        }

        return $documents;
    }

    public function get(int $id): Document
    {
        return $this->getClient()->call(null, $id, 'docuemnts', Document::class, false, 'GET');
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

        return $this->getClient()->call(null, $document, 'documents', OriginalFile::class, false, 'GET', '/original_file');
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

        $this->getClient()->call(null, $document, 'documents', null, false, 'DELETE');
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

        $this->getClient()->call(null, $document, 'documents', OriginalFile::class, false, 'POST', sprintf(
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
                $queryString[] = sprintf('state[]=%s', $state);
            }
        }

        if (count($ids) > 0) {
            foreach ($ids as $id) {
                $queryString[] = sprintf('ids[]=%s', $id);
            }
        }

        return $this->getClient()->call(null, sprintf('?%s', implode('&', $queryString)), 'documents', Document::class, true, 'GET');
    }
}
