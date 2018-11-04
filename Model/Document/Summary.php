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

class Summary
{
    /** @var float|null */
    private $shipping;

    /** @var float|null */
    private $other_cost1;

    /** @var float|null */
    private $other_cost2;

    /** @var float|null */
    private $other_cost3;

    /** @var float|null */
    private $total_discount;

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
     *
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
     *
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
     *
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
     *
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
     *
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
     *
     * @return Summary
     */
    public function setTotal(float $total): Summary
    {
        $this->total = $total;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getShipping(): ?float
    {
        return $this->shipping;
    }

    /**
     * @param float|null $shipping
     *
     * @return Summary
     */
    public function setShipping(?float $shipping): Summary
    {
        $this->shipping = $shipping;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getOtherCost1(): ?float
    {
        return $this->other_cost1;
    }

    /**
     * @param float|null $other_cost1
     *
     * @return Summary
     */
    public function setOtherCost1(?float $other_cost1): Summary
    {
        $this->other_cost1 = $other_cost1;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getOtherCost2(): ?float
    {
        return $this->other_cost2;
    }

    /**
     * @param float|null $other_cost2
     *
     * @return Summary
     */
    public function setOtherCost2(?float $other_cost2): Summary
    {
        $this->other_cost2 = $other_cost2;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getOtherCost3(): ?float
    {
        return $this->other_cost3;
    }

    /**
     * @param float|null $other_cost3
     *
     * @return Summary
     */
    public function setOtherCost3(?float $other_cost3): Summary
    {
        $this->other_cost3 = $other_cost3;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getTotalDiscount(): ?float
    {
        return $this->total_discount;
    }

    /**
     * @param float|null $total_discount
     *
     * @return Summary
     */
    public function setTotalDiscount(?float $total_discount): Summary
    {
        $this->total_discount = $total_discount;

        return $this;
    }
}
