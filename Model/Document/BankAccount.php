<?php
declare(strict_types=1);


namespace Cwd\Datamolino\Model\Document;


class BankAccount
{
    /** @var int|null */
    private $bban;

    /** @var int|null */
    private $bank_code;

    /** @var string|null */
    private $bic;

    /** @var string|null */
    private $iban;

    /**
     * @return int|null
     */
    public function getBban(): ?int
    {
        return $this->bban;
    }

    /**
     * @param int|null $bban
     * @return BankAccount
     */
    public function setBban(?int $bban): BankAccount
    {
        $this->bban = $bban;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getBankCode(): ?int
    {
        return $this->bank_code;
    }

    /**
     * @param int|null $bank_code
     * @return BankAccount
     */
    public function setBankCode(?int $bank_code): BankAccount
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