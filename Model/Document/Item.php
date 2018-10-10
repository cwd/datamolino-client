<?php
declare(strict_types=1);


namespace Cwd\Datamolino\Model\Document;


class Item
{
    /** @var string|null */
    private $code;

    /** @var string|null */
    private $name;

    /** @var int|null */
    private $quantity;

    /** @var string|null */
    private $unit;

    /** @var string|null */
    private $unit_price;

    /** @var int */
    private $tax_rate = 0;

    /** @var float */
    private $subtotal = 0;

    /** @var float */
    private $tax = 0;

    /** @var float */
    private $total = 0;

    /**
     * @return null|string
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @param null|string $code
     * @return Item
     */
    public function setCode(?string $code): Item
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param null|string $name
     * @return Item
     */
    public function setName(?string $name): Item
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    /**
     * @param int|null $quantity
     * @return Item
     */
    public function setQuantity(?int $quantity): Item
    {
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getUnit(): ?string
    {
        return $this->unit;
    }

    /**
     * @param null|string $unit
     * @return Item
     */
    public function setUnit(?string $unit): Item
    {
        $this->unit = $unit;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getUnitPrice(): ?string
    {
        return $this->unit_price;
    }

    /**
     * @param null|string $unit_price
     * @return Item
     */
    public function setUnitPrice(?string $unit_price): Item
    {
        $this->unit_price = $unit_price;
        return $this;
    }

    /**
     * @return int
     */
    public function getTaxRate(): int
    {
        return $this->tax_rate;
    }

    /**
     * @param int $tax_rate
     * @return Item
     */
    public function setTaxRate(int $tax_rate): Item
    {
        $this->tax_rate = $tax_rate;
        return $this;
    }

    /**
     * @return float
     */
    public function getSubtotal(): float
    {
        return $this->subtotal;
    }

    /**
     * @param float $subtotal
     * @return Item
     */
    public function setSubtotal(float $subtotal): Item
    {
        $this->subtotal = $subtotal;
        return $this;
    }

    /**
     * @return float
     */
    public function getTax(): float
    {
        return $this->tax;
    }

    /**
     * @param float $tax
     * @return Item
     */
    public function setTax(float $tax): Item
    {
        $this->tax = $tax;
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
     * @return Item
     */
    public function setTotal(float $total): Item
    {
        $this->total = $total;
        return $this;
    }
}