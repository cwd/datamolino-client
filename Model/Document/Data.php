<?php
declare(strict_types=1);

namespace Cwd\Datamolino\Model\Document;


class Data
{
    /** @var Header */
    private $header;

    /** @var BankAccount */
    private $bank_account;

    /** @var Supplier */
    private $supplier;

    /** @var Customer */
    private $customer;

    /** @var Summary */
    private $summary;

    /** @var TaxLine[] */
    private $tax_lines = [];

    /** @var Item[] */
    private $items = [];

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

    /**
     * @return BankAccount
     */
    public function getBankAccount(): BankAccount
    {
        return $this->bank_account;
    }

    /**
     * @param BankAccount $bank_account
     * @return Data
     */
    public function setBankAccount(BankAccount $bank_account): Data
    {
        $this->bank_account = $bank_account;
        return $this;
    }

    /**
     * @return Supplier
     */
    public function getSupplier(): Supplier
    {
        return $this->supplier;
    }

    /**
     * @param Supplier $supplier
     * @return Data
     */
    public function setSupplier(Supplier $supplier): Data
    {
        $this->supplier = $supplier;
        return $this;
    }

    /**
     * @return Customer
     */
    public function getCustomer(): Customer
    {
        return $this->customer;
    }

    /**
     * @param Customer $customer
     * @return Data
     */
    public function setCustomer(Customer $customer): Data
    {
        $this->customer = $customer;
        return $this;
    }

    /**
     * @return Summary
     */
    public function getSummary(): Summary
    {
        return $this->summary;
    }

    /**
     * @param Summary $summary
     * @return Data
     */
    public function setSummary(Summary $summary): Data
    {
        $this->summary = $summary;
        return $this;
    }

    /**
     * @return TaxLine[]
     */
    public function getTaxLines(): array
    {
        return $this->tax_lines;
    }

    public function addTaxLine(TaxLine $taxLine): Data
    {
        $this->tax_lines[] = $taxLine;
        return $this;
    }

    /**
     * @param TaxLine[] $tax_lines
     * @return Data
     */
    public function setTaxLines(array $tax_lines): Data
    {
        $this->tax_lines = $tax_lines;
        return $this;
    }

    /**
     * @return Item[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    public function addItem(Item $item): Data
    {
        $this->items[] = $item;
        return $this;
    }

    /**
     * @param Item[] $items
     * @return Data
     */
    public function setItems(array $items): Data
    {
        $this->items = $items;
        return $this;
    }
}