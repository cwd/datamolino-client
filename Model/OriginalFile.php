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

class OriginalFile
{
    /** @var int */
    private $id;

    /** @var string */
    private $user_file_name;

    /** @var string */
    private $original_content_type;

    /** @var string */
    private $original_file_base64;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return OriginalFile
     */
    public function setId(int $id): OriginalFile
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getUserFileName(): string
    {
        return $this->user_file_name;
    }

    /**
     * @param string $user_file_name
     *
     * @return OriginalFile
     */
    public function setUserFileName(string $user_file_name): OriginalFile
    {
        $this->user_file_name = $user_file_name;

        return $this;
    }

    /**
     * @return string
     */
    public function getOriginalContentType(): string
    {
        return $this->original_content_type;
    }

    /**
     * @param string $original_content_type
     *
     * @return OriginalFile
     */
    public function setOriginalContentType(string $original_content_type): OriginalFile
    {
        $this->original_content_type = $original_content_type;

        return $this;
    }

    /**
     * @return string
     */
    public function getOriginalFileBase64(): string
    {
        return $this->original_file_base64;
    }

    /**
     * @param string $original_file_base64
     *
     * @return OriginalFile
     */
    public function setOriginalFileBase64(string $original_file_base64): OriginalFile
    {
        $this->original_file_base64 = $original_file_base64;

        return $this;
    }

    public function getOrginalFile()
    {
        return base64_decode($this->original_file_base64);
    }
}
