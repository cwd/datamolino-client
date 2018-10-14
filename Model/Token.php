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

class Token
{
    /** @var string */
    private $access_token;
    /** @var string */
    private $token_type;
    /** @var int */
    private $expires_in;
    /** @var string */
    private $refresh_token;

    /**
     * @return string
     */
    public function getAccessToken(): string
    {
        return $this->access_token;
    }

    /**
     * @param string $access_token
     *
     * @return Token
     */
    public function setAccessToken(string $access_token): Token
    {
        $this->access_token = $access_token;

        return $this;
    }

    /**
     * @return string
     */
    public function getTokenType(): string
    {
        return $this->token_type;
    }

    /**
     * @param string $token_type
     *
     * @return Token
     */
    public function setTokenType(string $token_type): Token
    {
        $this->token_type = $token_type;

        return $this;
    }

    /**
     * @return int
     */
    public function getExpiresIn(): int
    {
        return $this->expires_in;
    }

    /**
     * @param int $expires_in
     *
     * @return Token
     */
    public function setExpiresIn(int $expires_in): Token
    {
        $this->expires_in = $expires_in;

        return $this;
    }

    /**
     * @return string
     */
    public function getRefreshToken(): string
    {
        return $this->refresh_token;
    }

    /**
     * @param string $refreshToken
     *
     * @return Token
     */
    public function setRefreshToken(string $refreshToken): Token
    {
        $this->refresh_token = $refreshToken;

        return $this;
    }
}
