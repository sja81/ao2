<?php

namespace common\models\mrp\xmlgenerator;

use Yii;

class SumValues
{
    private $taxCode;
    private $taxType;
    private $taxPercent;
    private $currencyCode = '';
    private $amount;
    private $tax;
    private $taxCurrRateAmount;
    private $taxCurrRateTax;
    private $reverseChargeAmount;
    private $reverseChargeTax;
    private $taxCurrRateReverseChargeAmount;
    private $taxCurrRateReverseChargeTax;
    private $taxApplied;

    public function getTaxTypes()
    {
        return [
            0 =>  Yii::t('app', 'Neuvedené'),
            1 =>  Yii::t('app', 'Základná'),
            2 =>  Yii::t('app', 'Znížnená'),
            3 =>  Yii::t('app', 'Oslobodené'),
            4 =>  Yii::t('app', 'MimoDph'),

        ];
    }

    public function getTaxCode(): int
    {
        return $this->taxCode;
    }

    public function setTaxCode(int $taxCode): void
    {
        $this->TaxCode = $taxCode;
    }

    public function getTaxType(): int
    {
        return $this->taxType;
    }

    public function setTaxType(int $taxType): void
    {
        $this->taxType = $taxType;
    }

    public function getTaxPercent(): int
    {
        return $this->taxPercent;
    }

    public function setTaxPerceent(int $taxPercent): void
    {
        $this->taxPercent = $taxPercent;
    }

    public function getCurrencyCode(): string
    {
        return $this->currencyCode;
    }

    public function setCurrencyCode(string $currencyCode): void
    {
        $this->currencyCode = $currencyCode;
    }
    public function getAmount(): int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): void
    {
        $this->amount = $amount;
    }

    public function getTax(): int
    {
        return $this->tax;
    }

    public function setTax(int $tax): void
    {
        $this->tax = $tax;
    }

    public function getTaxCurrRateAmount(): int
    {
        return $this->taxCurrRateAmount;
    }

    public function setTaxCurrRateAmount(int $taxCurrRateAmount): void
    {
        $this->taxCurrRateAmount = $taxCurrRateAmount;
    }

    public function getTaxCurrRateTax(): int
    {
        return $this->taxCurrRateTax;
    }

    public function setTaxCurrRateTax(int $taxCurrRateTax): void
    {
        $this->taxCurrRateTax = $taxCurrRateTax;
    }

    public function getReverseChargeAmount(): int
    {
        return $this->reverseChargeAmount;
    }

    public function setReverseChargeAmount(int $reverseChargeAmount): void
    {
        $this->reverseChargeAmount = $reverseChargeAmount;
    }

    public function getReverseChargeTax(): int
    {
        return $this->reverseChargeTax;
    }

    public function setReverseChargeTax(int $reverseChargeTax): void
    {
        $this->reverseChargeTax = $reverseChargeTax;
    }

    public function getTaxCurrRateReverseChargeAmount(): int
    {
        return $this->taxCurrRateReverseChargeAmount;
    }

    public function setTaxCurrRateReverseChargeAmount(int $taxCurrRateReverseChargeAmount): void
    {
        $this->taxCurrRateReverseChargeAmount = $taxCurrRateReverseChargeAmount;
    }

    public function getTaxCurrRateReverseChargeTax(): int
    {
        return $this->taxCurrRateReverseChargeTax;
    }

    public function setTaxCurrRateReverseChargeTax(int $taxCurrRateReverseChargeTax): void
    {
        $this->taxCurrRateReverseChargeTax = $taxCurrRateReverseChargeTax;
    }

    public function getTaxApplied(): int
    {
        return $this->taxApplied;
    }

    public function setTaxApplid(int $taxApplied): void
    {
        $this->taxApplied = $taxApplied;
    }
}
