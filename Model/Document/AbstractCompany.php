<?php
declare(strict_types=1);


namespace Cwd\Datamolino\Model\Document;


abstract class AbstractCompany
{
    /** @var int */
    protected $id;

    /** @var string|null */
    protected $tax_id;

    /** @var string|null */
    protected $vat_id;

    /** @var string|null */
    protected $street;

    /** @var string|null */
    protected $city;

    /** @var string|null */
    protected $postal_code;

    /** @var string|null */
    protected $country;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return AbstractCompany
     */
    public function setId($id): AbstractCompany
    {
        if ($id == '') {
            return $this;
        }
        $this->id = intval($id);
        return $this;
    }

    /**
     * @return null|string
     */
    public function getTaxId(): ?string
    {
        return $this->tax_id;
    }

    /**
     * @param null|string $tax_id
     * @return AbstractCompany
     */
    public function setTaxId(?string $tax_id): AbstractCompany
    {
        $this->tax_id = $tax_id;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getVatId(): ?string
    {
        return $this->vat_id;
    }

    /**
     * @param null|string $vat_id
     * @return AbstractCompany
     */
    public function setVatId(?string $vat_id): AbstractCompany
    {
        $this->vat_id = $vat_id;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getStreet(): ?string
    {
        return $this->street;
    }

    /**
     * @param null|string $street
     * @return AbstractCompany
     */
    public function setStreet(?string $street): AbstractCompany
    {
        $this->street = $street;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param null|string $city
     * @return AbstractCompany
     */
    public function setCity(?string $city): AbstractCompany
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getPostalCode(): ?string
    {
        return $this->postal_code;
    }

    /**
     * @param null|string $postal_code
     * @return AbstractCompany
     */
    public function setPostalCode(?string $postal_code): AbstractCompany
    {
        $this->postal_code = $postal_code;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getCountry(): ?string
    {
        return $this->country;
    }

    /**
     * @param null|string $country
     * @return AbstractCompany
     */
    public function setCountry(?string $country): AbstractCompany
    {
        $this->country = $country;
        return $this;
    }
}