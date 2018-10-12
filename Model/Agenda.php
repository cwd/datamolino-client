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

class Agenda
{
    /** @var int|null */
    private $id;

    /** @var string|null */
    private $name;

    /** @var string|null */
    private $company_id;

    /** @var string|null */
    private $company_tax_id;

    /** @var string|null */
    private $company_vat_id;

    /** @var string */
    private $home_currency = 'EUR';

    /** @var string|null */
    private $email_alias;

    /** @var string|null */
    private $email_whitelist;

    /** @var Address|null */
    private $address;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     *
     * @return Agenda
     */
    public function setId(?int $id): Agenda
    {
        $this->id = $id;

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
     *
     * @return Agenda
     */
    public function setName(?string $name): Agenda
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getCompanyId(): ?string
    {
        return $this->company_id;
    }

    /**
     * @param null|string $company_id
     *
     * @return Agenda
     */
    public function setCompanyId(?string $company_id): Agenda
    {
        $this->company_id = $company_id;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getCompanyTaxId(): ?string
    {
        return $this->company_tax_id;
    }

    /**
     * @param null|string $company_tax_id
     *
     * @return Agenda
     */
    public function setCompanyTaxId(?string $company_tax_id): Agenda
    {
        $this->company_tax_id = $company_tax_id;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getCompanyVatId(): ?string
    {
        return $this->company_vat_id;
    }

    /**
     * @param null|string $company_vat_id
     *
     * @return Agenda
     */
    public function setCompanyVatId(?string $company_vat_id): Agenda
    {
        $this->company_vat_id = $company_vat_id;

        return $this;
    }

    /**
     * @return string
     */
    public function getHomeCurrency(): string
    {
        return $this->home_currency;
    }

    /**
     * @param string $home_currency
     *
     * @return Agenda
     */
    public function setHomeCurrency(string $home_currency): Agenda
    {
        $this->home_currency = $home_currency;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getEmailAlias(): ?string
    {
        return $this->email_alias;
    }

    /**
     * @param null|string $email_alias
     *
     * @return Agenda
     */
    public function setEmailAlias(?string $email_alias): Agenda
    {
        $this->email_alias = $email_alias;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getEmailWhitelist(): ?string
    {
        return $this->email_whitelist;
    }

    /**
     * @param null|string $email_whitelist
     *
     * @return Agenda
     */
    public function setEmailWhitelist(?string $email_whitelist): Agenda
    {
        $this->email_whitelist = $email_whitelist;

        return $this;
    }

    /**
     * @return Address|null
     */
    public function getAddress(): ?Address
    {
        return $this->address;
    }

    /**
     * @param Address|null $address
     *
     * @return Agenda
     */
    public function setAddress(?Address $address): Agenda
    {
        $this->address = $address;

        return $this;
    }
}
