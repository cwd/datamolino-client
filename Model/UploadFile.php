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

class UploadFile
{
    /** @var int|null */
    private $id;

    /** @var string */
    private $filename;

    /** @var string */
    private $content_type;

    /** @var string */
    private $content;

    public function __construct(string $filename, string $contentType, string $content)
    {
        $this->setFilename($filename);
        $this->setContentType($contentType);
        $this->setContent($content);
    }

    /**
     * @return string
     */
    public function getFilename(): string
    {
        return $this->filename;
    }

    /**
     * @param string $filename
     *
     * @return UploadFile
     */
    public function setFilename(string $filename): UploadFile
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * @return string
     */
    public function getContentType(): string
    {
        return $this->content_type;
    }

    /**
     * @param string $content_type
     *
     * @return UploadFile
     */
    public function setContentType(string $content_type): UploadFile
    {
        $this->content_type = $content_type;

        return $this;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     *
     * @return UploadFile
     */
    public function setContent(string $content): UploadFile
    {
        $this->content = base64_encode($content);

        return $this;
    }
}
