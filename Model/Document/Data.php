<?php
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
     * @return Data
     */
    public function setHeader(Header $header): Data
    {
        $this->header = $header;
        return $this;
    }
}