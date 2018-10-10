<?php
declare(strict_types=1);


namespace Cwd\Datamolino\Model;


use Cwd\Datamolino\Model\Document\Data;

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
    private $last_modifed_at;

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

    /** @var string|null */
    private $invoice_type;

    /** @var int|null */
    private $parent_document_id;

    /** @var Data */
    private $data;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
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
    public function getLastModifedAt(): ?\DateTime
    {
        return $this->last_modifed_at;
    }

    /**
     * @param \DateTime|null $last_modifed_at
     * @return Document
     */
    public function setLastModifedAt(?\DateTime $last_modifed_at): Document
    {
        $this->last_modifed_at = $last_modifed_at;
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
     * @return Document
     */
    public function setUserFileName(?string $user_file_name): Document
    {
        $this->user_file_name = $user_file_name;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getInvoiceType(): ?string
    {
        return $this->invoice_type;
    }

    /**
     * @param null|string $invoice_type
     * @return Document
     */
    public function setInvoiceType(?string $invoice_type): Document
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
     * @return Document
     */
    public function setData(Data $data): Document
    {
        $this->data = $data;
        return $this;
    }
}