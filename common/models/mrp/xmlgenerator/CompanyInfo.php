<?php

namespace common\models\mrp\xmlgenerator;

use common\models\accounting\invoice\Invoice;
use common\models\Customer;
use common\models\InvoiceCustomer;
use Yii;

class CompanyInfo
{
    private $companyName = '';
    private $name = '';
    private $street = '';
    private $city = '';
    private $country = '';
    private $zipCode = '';
    private $vatNumber = '';
    private $icdph = '';
    private $naturalPerson  = '';
    private $companyIco = '';
    private $note = '';
    private $supplierTitle = '';
    private $supplierName = '';
    private $supplierStreet = '';
    private $supplierStreetCode = '';
    private $supplierCountry = '';

    /**
     * @param InvoiceCustomer $info
     * @return void
     */

    public function load(InvoiceCustomer $info)
    {
        $this->companyName = $info->nazov;
        $this->name = $info->kontaktna_osoba;
        $this->street = $info->ulica;
        $this->city = $info->mesto;
        $this->zipCode = $info->psc;
        $this->country = $info->stat;
        $this->companyIco = $info->ico;
        $this->vatNumber = $info->dic;
        $this->icdph = $info->icdph;
        $this->note = $info->poznamka;
        $this->supplierTitle = $info->dodacia_nazov;
        $this->supplierName = $info->dodacia_kontaktna_osoba;
        $this->supplierStreet = $info->dodacia_ulica;
        $this->supplierStreetCode = $info->dodacia_psc;
        $this->supplierCountry = $info->dodacia_stat;

        return $this;
    }

    public function getNaturalPersonType()
    {
        return [
            "T" => Yii::t('app', 'Fyzická osoba'),
            "F" => Yii::t('app', 'Právnická osoba'),
            "P" => Yii::t('app', 'Penilazačná')
        ];
    }

    public function getCompanyName(): string
    {
        return $this->companyName;
    }

    public function setCompanyName(string $companyName): void
    {
        $this->companyName = $companyName;
    }


    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }


    public function getStreet(): string
    {
        return $this->street;
    }

    /**
     * @param string $street
     */
    public function setStreet(string $street): void
    {
        $this->street = $street;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @param string $country
     */
    public function setCounty(string $country): void
    {
        $this->country = $country;
    }

    public function getZipCode(): string
    {
        return $this->zipCode;
    }

    /**
     * @param string $zipCode
     */
    public function setZipCode(string $zipCode): void
    {
        $this->zipCode = $zipCode;
    }
    public function getVatNumber(): string
    {
        return $this->vatNumber;
    }

    /**
     * @param string $vatNumber
     */
    public function setVatNumber(string $vatNumber): void
    {
        $this->vatNumber = $vatNumber;
    }
    public function getNaturalPerson()
    {
        return $this->naturalPerson;
    }

    /**
     * @param string $naturalPerson
     */
    public function setNaturalPerson($naturalPerson): void
    {
        $this->naturalPerson = $naturalPerson;
    }

    public function getCompanyIco(): string
    {
        return $this->companyIco;
    }

    public function setCompanyIco(string $companyIco): void
    {
        $this->companyIco = $companyIco;
    }

    public function getIcDph(): string
    {
        return $this->icdph;
    }

    public function setIcDph(string $icdph): void
    {
        $this->icdph = $icdph;
    }

    public function getNote(): string
    {
        return $this->note;
    }

    public function setNote(string $note): void
    {
        $this->note = $note;
    }

    public function getSupplierTitle(): string
    {
        return $this->supplierTitle;
    }

    public function setSupplierTitle(string $supplierTitle): void
    {
        $this->supplierTitle = $supplierTitle;
    }

    public function getSupplierName(): string
    {
        return $this->supplierName;
    }

    public function setSupplierName(string $supplierName): void
    {
        $this->supplierName = $supplierName;
    }

    public function getSupplierStreet(): string
    {
        return $this->supplierStreet;
    }

    public function setSupplierStreet(string $supplierStreet): void
    {
        $this->supplierStreet = $supplierStreet;
    }

    public function getSupplierStreetCode(): string
    {
        return $this->supplierStreetCode;
    }

    public function setSupplierStreeCode(string $supplierStreetCode)
    {
        $this->supplierStreetCode = $supplierStreetCode;
    }

    public function getSupplierCountry(): string
    {
        return $this->supplierCountry;
    }

    public function setSupplierCountry(string $supplierCountry): void
    {
        $this->supplierCountry = $supplierCountry;
    }
}
