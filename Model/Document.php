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

namespace Cwd\Datamolino\Model;

use Cwd\Datamolino\Model\Document\BankAccount;
use Cwd\Datamolino\Model\Document\Customer;
use Cwd\Datamolino\Model\Document\Data;
use Cwd\Datamolino\Model\Document\Item;
use Cwd\Datamolino\Model\Document\Summary;
use Cwd\Datamolino\Model\Document\Supplier;
use Cwd\Datamolino\Model\Document\TaxLine;

class Document
{
    const TYPE_INVOICE = 0;
    const TYPE_CREDIT_NOTE = 1;
    const TYPE_PROFORMA_INVOICE = 2;
    const TYPE_RECEIPT = 3;

    const DOCTYPE_PURCHASE = 'PurchaseInvoice';
    const DOCTYPE_SALES = 'SalesInvoice';

    const STATES = [
        'uploaded',
        'extracting',
        'templating',
        'extracted',
        'verifying',
        'verifying_individual',
        'extracting_items',
        'repairing',
        'ready',
        'not_ready',
        'parent',
        'trash',
        'file_duplicate',
        'data_duplicate',
        'exporting',
        'auto_exporting',
        'exported',
        'auto_exported',
    ];

    /** @var int */
    private $id;

    /** @var string */
    private $type;

    /** @var \DateTime|null */
    private $created_at;

    /** @var \DateTime|null */
    private $last_modified_at;

    /** @var string */
    private $state;

    /** @var string|null */
    private $verificator_response;

    /** @var string|null */
    private $preview;

    /** @var string|null */
    private $original;

    /** @var string|null */
    private $user_file_name;

    /** @var int|null */
    private $invoice_type;

    /** @var int|null */
    private $parent_document_id;

    /** @var Data */
    private $data;

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
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return Document
     */
    public function setId(int $id): Document
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return Document
     */
    public function setType(string $type): Document
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getCreatedAt(): ?\DateTime
    {
        return $this->created_at;
    }

    /**
     * @param \DateTime|null $created_at
     *
     * @return Document
     */
    public function setCreatedAt(?\DateTime $created_at): Document
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getLastModifiedAt(): ?\DateTime
    {
        return $this->last_modified_at;
    }

    /**
     * @param \DateTime|null $last_modified_at
     *
     * @return Document
     */
    public function setLastModifiedAt(?\DateTime $last_modified_at): Document
    {
        $this->last_modified_at = $last_modified_at;

        return $this;
    }

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * @param string $state
     *
     * @return Document
     */
    public function setState(string $state): Document
    {
        $this->state = $state;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getVerificatorResponse(): ?string
    {
        return $this->verificator_response;
    }

    /**
     * @param null|string $verificator_response
     *
     * @return Document
     */
    public function setVerificatorResponse(?string $verificator_response): Document
    {
        $this->verificator_response = $verificator_response;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getPreview(): ?string
    {
        return $this->preview;
    }

    /**
     * @param null|string $preview
     *
     * @return Document
     */
    public function setPreview(?string $preview): Document
    {
        $this->preview = $preview;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getOriginal(): ?string
    {
        return $this->original;
    }

    /**
     * @param null|string $original
     *
     * @return Document
     */
    public function setOriginal(?string $original): Document
    {
        $this->original = $original;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getUserFileName(): ?string
    {
        return $this->user_file_name;
    }

    /**
     * @param null|string $user_file_name
     *
     * @return Document
     */
    public function setUserFileName(?string $user_file_name): Document
    {
        $this->user_file_name = $user_file_name;

        return $this;
    }

    /**
     * @return null|int
     */
    public function getInvoiceType(): ?int
    {
        return $this->invoice_type;
    }

    /**
     * @param int|null $invoice_type
     *
     * @return Document
     */
    public function setInvoiceType(?int $invoice_type): Document
    {
        $this->invoice_type = $invoice_type;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getParentDocumentId(): ?int
    {
        return $this->parent_document_id;
    }

    /**
     * @param int|null $parent_document_id
     *
     * @return Document
     */
    public function setParentDocumentId(?int $parent_document_id): Document
    {
        $this->parent_document_id = $parent_document_id;

        return $this;
    }

    /**
     * @return Data
     */
    public function getData(): Data
    {
        return $this->data;
    }

    /**
     * @param Data $data
     *
     * @return Document
     */
    public function setData(Data $data): Document
    {
        $this->data = $data;

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
     *
     * @return Document
     */
    public function setBankAccount(BankAccount $bank_account): Document
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
     *
     * @return Document
     */
    public function setSupplier(Supplier $supplier): Document
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
     *
     * @return Document
     */
    public function setCustomer(Customer $customer): Document
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
     *
     * @return Document
     */
    public function setSummary(Summary $summary): Document
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

    /**
     * @param TaxLine[] $tax_lines
     *
     * @return Document
     */
    public function setTaxLines(array $tax_lines): Document
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

    /**
     * @param Item[] $items
     *
     * @return Document
     */
    public function setItems(array $items): Document
    {
        $this->items = $items;

        return $this;
    }
}
