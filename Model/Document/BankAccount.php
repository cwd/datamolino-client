<?php
declare(strict_types=1);


namespace Cwd\Datamolino\Model\Document;


class BankAccount
{
    /** @var string|null */
    private $bban;

    /** @var string|null */
    private $bank_code;

    /** @var string|null */
    private $bic;

    /** @var string|null */
    private $iban;

    /**
     * @return null|string
     */
    public function getBban(): ?string
    {
        return $this->bban;
    }

    /**
     * @param null|string $bban
     * @return BankAccount
     */
    public function setBban(?string $bban): BankAccount
    {
        $this->bban = $bban;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getBankCode(): ?string
    {
        return $this->bank_code;
    }

    /**
     * @param string|null $bank_code
     * @return BankAccount
     */
    public function setBankCode(?string $bank_code): BankAccount
    {
        $this->bank_code = $bank_code;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getBic(): ?string
    {
        return $this->bic;
    }

    /**
     * @param null|string $bic
     * @return BankAccount
     */
    public function setBic(?string $bic): BankAccount
    {
        $this->bic = $bic;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getIban(): ?string
    {
        return $this->iban;
    }

    /**
     * @param null|string $iban
     * @return BankAccount
     */
    public function setIban(?string $iban): BankAccount
    {
        $this->iban = $iban;
        return $this;
    }
}