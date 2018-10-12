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

namespace Cwd\Datamolino\Model;

class DocumentFile
{
    /** @var UploadFile[] */
    private $files = [];
    /** @var int */
    private $agendaId;
    /** @var bool */
    private $fileSplit = false;
    /** @var string */
    private $type = Document::DOCTYPE_PURCHASE;

    /**
     * @return UploadFile[]
     */
    public function getFiles(): array
    {
        return $this->files;
    }

    /**
     * @param UploadFile[] $files
     *
     * @return DocumentFile
     */
    public function setFiles(array $files): DocumentFile
    {
        $this->files = $files;

        return $this;
    }

    public function setFile(UploadFile $file): DocumentFile
    {
        $this->files[] = $file;

        return $this;
    }

    /**
     * @return int
     */
    public function getAgendaId(): int
    {
        return $this->agendaId;
    }

    /**
     * @param int $agendaId
     *
     * @return DocumentFile
     */
    public function setAgendaId(int $agendaId): DocumentFile
    {
        $this->agendaId = $agendaId;

        return $this;
    }

    /**
     * @return bool
     */
    public function isFileSplit(): bool
    {
        return $this->fileSplit;
    }

    /**
     * @param bool $fileSplit
     *
     * @return DocumentFile
     */
    public function setFileSplit(bool $fileSplit): DocumentFile
    {
        $this->fileSplit = $fileSplit;

        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return DocumentFile
     */
    public function setType(string $type): DocumentFile
    {
        $this->type = $type;

        return $this;
    }
}
