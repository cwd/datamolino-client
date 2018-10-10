<?php
declare(strict_types=1);

namespace Cwd\Datamolino\Model\Document;


class TaxLine
{
    /** @var int */
    private $percent;

    /** @var float */
    private $sub_total = 0;

    /** @var float */
    private $vat_total = 0;

    /** @var float */
    private $total = 0;

    /**
     * @return int
     */
    public function getPercent(): int
    {
        return $this->percent;
    }

    /**
     * @param int $percent
     * @return TaxLine
     */
    public function setPercent(int $percent): TaxLine
    {
        $this->percent = $percent;
        return $this;
    }

    /**
     * @return float
     */
    public function getSubTotal(): float
    {
        return $this->sub_total;
    }

    /**
     * @param float $sub_total
     * @return TaxLine
     */
    public function setSubTotal(float $sub_total): TaxLine
    {
        $this->sub_total = $sub_total;
        return $this;
    }

    /**
     * @return float
     */
    public function getVatTotal(): float
    {
        return $this->vat_total;
    }

    /**
     * @param float $vat_total
     * @return TaxLine
     */
    public function setVatTotal(float $vat_total): TaxLine
    {
        $this->vat_total = $vat_total;
        return $this;
    }

    /**
     * @return float
     */
    public function getTotal(): float
    {
        return $this->total;
    }

    /**
     * @param float $total
     * @return TaxLine
     */
    public function setTotal(float $total): TaxLine
    {
        $this->total = $total;
        return $this;
    }
}