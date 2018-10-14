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

use Cwd\Datamolino\Endpoints\AgendaEndpoint;
use Cwd\Datamolino\Endpoints\DocumentEndpoint;
use Cwd\Datamolino\Endpoints\UserEndpoint;

class DatamolinoClient
{
    /** @var Client */
    private $client;

    /** @var UserEndpoint */
    private $userEndpoint;
    /** @var AgendaEndpoint */
    private $agendaEndpoint;
    /** @var DocumentEndpoint */
    private $documentEndpoint;

    public function __construct(?Client $client = null)
    {
        if ($client === null) {
            $this->client = new Client();
        } else {
            $this->client = $client;
        }
    }

    public function user(): UserEndpoint
    {
        if (null === $this->userEndpoint) {
            $this->userEndpoint = new UserEndpoint($this->getClient());
        }

        return $this->userEndpoint;
    }

    public function agenda(): AgendaEndpoint
    {
        if (null === $this->agendaEndpoint) {
            $this->agendaEndpoint = new AgendaEndpoint($this->getClient());
        }

        return $this->agendaEndpoint;
    }

    public function document(): DocumentEndpoint
    {
        if (null === $this->documentEndpoint) {
            $this->documentEndpoint = new DocumentEndpoint($this->getClient());
        }

        return $this->documentEndpoint;
    }

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }
}
