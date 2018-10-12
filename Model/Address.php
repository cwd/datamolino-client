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

class Address
{
    /** @var string|null */
    private $street;

    /** @var string|null */
    private $building_no;

    /** @var string|null */
    private $city;

    /** @var string|null */
    private $postal_code;

    /** @var string|null */
    private $country;

    /**
     * @return null|string
     */
    public function getStreet(): ?string
    {
        return $this->street;
    }

    /**
     * @param null|string $street
     *
     * @return Address
     */
    public function setStreet(?string $street): Address
    {
        $this->street = $street;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getBuildingNo(): ?string
    {
        return $this->building_no;
    }

    /**
     * @param null|string $building_no
     *
     * @return Address
     */
    public function setBuildingNo(?string $building_no): Address
    {
        $this->building_no = $building_no;

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
     *
     * @return Address
     */
    public function setCity(?string $city): Address
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
     *
     * @return Address
     */
    public function setPostalCode(?string $postal_code): Address
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
     *
     * @return Address
     */
    public function setCountry(?string $country): Address
    {
        $this->country = $country;

        return $this;
    }
}
