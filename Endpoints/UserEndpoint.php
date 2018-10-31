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

use Cwd\Datamolino\Model\User;

class UserEndpoint extends AbstractEndpoint
{
    const ENDPOINT = 'me';

    /**
     * @return User
     *
     * @throws \Http\Client\Exception
     */
    public function me(): User
    {
        // Result is different - denormalize by hand
        $data = $this->getClient()->call(null, null, self::ENDPOINT, null, false, 'GET');

        return $this->getClient()->denormalizeObject(User::class, [$data], false);
    }
}
