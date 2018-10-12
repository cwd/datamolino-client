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

namespace Cwd\Datamolino\Model\Document;

class Data
{
    /** @var Header */
    private $header;

    /**
     * @return Header
     */
    public function getHeader(): Header
    {
        return $this->header;
    }

    /**
     * @param Header $header
     *
     * @return Data
     */
    public function setHeader(Header $header): Data
    {
        $this->header = $header;

        return $this;
    }
}
