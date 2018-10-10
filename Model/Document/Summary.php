<?php
declare(strict_types=1);


namespace Cwd\Datamolino\Model\Document;


class Summary
{
    /** @var float|null */
    private $payment_amount;

    /** @var float */
    private $paid_deposits = 0;

    /** @var float */
    private $rounding = 0;

    /** @var float */
    private $sub_total = 0;

    /** @var float */
    private $vat_total = 0;

    /** @var float */
    private $total = 0;

    /**
     * @return float|null
     */
    public function getPaymentAmount(): ?float
    {
        return $this->payment_amount;
    }

    /**
     * @param float|null $payment_amount
     * @return Summary
     */
    public function setPaymentAmount(?float $payment_amount): Summary
    {
        $this->payment_amount = $payment_amount;
        return $this;
    }

    /**
     * @return float
     */
    public function getPaidDeposits(): float
    {
        return $this->paid_deposits;
    }

    /**
     * @param float $paid_deposits
     * @return Summary
     */
    public function setPaidDeposits(float $paid_deposits): Summary
    {
        $this->paid_deposits = $paid_deposits;
        return $this;
    }

    /**
     * @return float
     */
    public function getRounding(): float
    {
        return $this->rounding;
    }

    /**
     * @param float $rounding
     * @return Summary
     */
    public function setRounding(float $rounding): Summary
    {
        $this->rounding = $rounding;
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
     * @return Summary
     */
    public function setSubTotal(float $sub_total): Summary
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
     * @return Summary
     */
    public function setVatTotal(float $vat_total): Summary
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
     * @return Summary
     */
    public function setTotal(float $total): Summary
    {
        $this->total = $total;
        return $this;
    }
}