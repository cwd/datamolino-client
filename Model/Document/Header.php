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

class Header
{
    /** @var string|null */
    private $locale;

    /** @var string|null */
    private $invoice_text;

    /** @var string|null */
    private $invoice_no;

    /** @var string|null */
    private $sepa_reference;

    /** @var string|null */
    private $variable_symbol;

    /** @var string|null */
    private $specific_symbol;

    /** @var \DateTime|null */
    private $issue_date;

    /** @var \DateTime|null */
    private $tax_date;

    /** @var \DateTime|null */
    private $due_date;

    /** @var string|null */
    private $currency;

    /** @var string|null */
    private $currency_rate;

    /** @var string|null */
    private $text;

    /** @var string|null */
    private $customer_no;

    /** @var string|null */
    private $purchase_order_no;

    /** @var string|null */
    private $reference;

    /** @var string|null */
    private $delivery_note_no;

    /** @var string|null */
    private $card_no;

    /**
     * @return null|string
     */
    public function getLocale(): ?string
    {
        return $this->locale;
    }

    /**
     * @param null|string $locale
     *
     * @return Header
     */
    public function setLocale(?string $locale): Header
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getInvoiceText(): ?string
    {
        return $this->invoice_text;
    }

    /**
     * @param null|string $invoice_text
     *
     * @return Header
     */
    public function setInvoiceText(?string $invoice_text): Header
    {
        $this->invoice_text = $invoice_text;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getInvoiceNo(): ?string
    {
        return $this->invoice_no;
    }

    /**
     * @param null|string $invoice_no
     *
     * @return Header
     */
    public function setInvoiceNo(?string $invoice_no): Header
    {
        $this->invoice_no = $invoice_no;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getSepaReference(): ?string
    {
        return $this->sepa_reference;
    }

    /**
     * @param null|string $sepa_reference
     *
     * @return Header
     */
    public function setSepaReference(?string $sepa_reference): Header
    {
        $this->sepa_reference = $sepa_reference;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getVariableSymbol(): ?string
    {
        return $this->variable_symbol;
    }

    /**
     * @param null|string $variable_symbol
     *
     * @return Header
     */
    public function setVariableSymbol(?string $variable_symbol): Header
    {
        $this->variable_symbol = $variable_symbol;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getSpecificSymbol(): ?string
    {
        return $this->specific_symbol;
    }

    /**
     * @param null|string $specific_symbol
     *
     * @return Header
     */
    public function setSpecificSymbol(?string $specific_symbol): Header
    {
        $this->specific_symbol = $specific_symbol;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getIssueDate(): ?\DateTime
    {
        return $this->issue_date;
    }

    /**
     * @param \DateTime|null $issue_date
     *
     * @return Header
     */
    public function setIssueDate(?\DateTime $issue_date): Header
    {
        $this->issue_date = $issue_date;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getTaxDate(): ?\DateTime
    {
        return $this->tax_date;
    }

    /**
     * @param \DateTime|null $tax_date
     *
     * @return Header
     */
    public function setTaxDate(?\DateTime $tax_date): Header
    {
        $this->tax_date = $tax_date;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getDueDate(): ?\DateTime
    {
        return $this->due_date;
    }

    /**
     * @param \DateTime|null $due_date
     *
     * @return Header
     */
    public function setDueDate(?\DateTime $due_date): Header
    {
        $this->due_date = $due_date;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    /**
     * @param null|string $currency
     *
     * @return Header
     */
    public function setCurrency(?string $currency): Header
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getCurrencyRate(): ?string
    {
        return $this->currency_rate;
    }

    /**
     * @param null|string $currency_rate
     *
     * @return Header
     */
    public function setCurrencyRate(?string $currency_rate): Header
    {
        $this->currency_rate = $currency_rate;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getText(): ?string
    {
        return $this->text;
    }

    /**
     * @param null|string $text
     *
     * @return Header
     */
    public function setText(?string $text): Header
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getCustomerNo(): ?string
    {
        return $this->customer_no;
    }

    /**
     * @param null|string $customer_no
     *
     * @return Header
     */
    public function setCustomerNo(?string $customer_no): Header
    {
        $this->customer_no = $customer_no;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getPurchaseOrderNo(): ?string
    {
        return $this->purchase_order_no;
    }

    /**
     * @param null|string $purchase_order_no
     *
     * @return Header
     */
    public function setPurchaseOrderNo(?string $purchase_order_no): Header
    {
        $this->purchase_order_no = $purchase_order_no;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getReference(): ?string
    {
        return $this->reference;
    }

    /**
     * @param null|string $reference
     *
     * @return Header
     */
    public function setReference(?string $reference): Header
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getDeliveryNoteNo(): ?string
    {
        return $this->delivery_note_no;
    }

    /**
     * @param null|string $delivery_note_no
     *
     * @return Header
     */
    public function setDeliveryNoteNo(?string $delivery_note_no): Header
    {
        $this->delivery_note_no = $delivery_note_no;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getCardNo(): ?string
    {
        return $this->card_no;
    }

    /**
     * @param null|string $card_no
     *
     * @return Header
     */
    public function setCardNo(?string $card_no): Header
    {
        $this->card_no = $card_no;

        return $this;
    }
}
