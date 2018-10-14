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

use Cwd\Datamolino\Model\Agenda;

class AgendaEndpoint extends AbstractEndpoint
{
    /**
     * @return Agenda[]
     *
     * @throws \Http\Client\Exception
     */
    public function getAll()
    {
        return $this->getClient()->call(null, null, 'agendas', Agenda::class, true, 'GET');
    }

    /**
     * @param int $id
     *
     * @return Agenda
     *
     * @throws \Http\Client\Exception
     */
    public function get(int $id): Agenda
    {
        return $this->getClient()->call(null, $id, 'agendas', Agenda::class, false, 'GET');
    }

    /**
     * @param Agenda $agenda
     * @param bool   $lazyLoad if false the agenda object only holds the ID
     *
     * @return Agenda
     *
     * @throws \Http\Client\Exception
     */
    public function create(Agenda $agenda, $lazyLoad = false): Agenda
    {
        $payload = $this->getClient()->getSerializer()->serialize(['agendas' => [$agenda]], 'json');
        $agenda = $this->getClient()->call($payload, null, 'agendas', Agenda::class, false, 'POST');

        if ($lazyLoad) {
            return $this->get($agenda->getId());
        }

        return $agenda;
    }

    /**
     * @param Agenda $agenda
     *
     * @return void|
     *
     * @throws \Http\Client\Exception
     */
    public function update(Agenda $agenda)
    {
        $payload = $this->getClient()->getSerializer()->serialize(['agendas' => [$agenda]], 'json');
        $this->getClient()->call($payload, $agenda->getId(), 'agendas', null, false, 'PUT');
    }

    /**
     * @param Agenda $agenda
     *
     * @return mixed
     *
     * @throws \Http\Client\Exception
     */
    public function delete(int $id): void
    {
        $this->getClient()->call(null, $id, 'agendas', null, false, 'DELETE');
    }
}
