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

use Cwd\Datamolino\Client as CwdClient;
use Cwd\Datamolino\Model\Token;

class SymfonyClient extends CwdClient
{
    private $clientId;
    private $clientSecret;
    private $username;
    private $password;
    private $hostname;

    public function __construct($clientId, $clientSecret, $username, $password, $hostname)
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->username = $username;
        $this->password = $password;
        $this->hostname = $hostname;

        parent::__construct();
    }

    public function authenticate(): Token
    {
        return parent::authenticatePassword($this->clientId, $this->clientSecret, $this->username, $this->password);
    }

    public function refresh($refreshToken): Token
    {
        return parent::refreshToken($this->clientId, $this->clientSecret, $refreshToken);
    }
}
