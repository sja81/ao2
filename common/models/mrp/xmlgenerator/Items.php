<?php

namespace common\models\mrp\xmlgenerator;

use common\models\InvoiceItem;

use Yii;


class Items
{
    private $description = '';
    private $rowType;
    private $taxCode;
    private $quanity;
    private $unitPrice;
    private $taxPercent;
    private $taxAmount;
    private $discountPercent;
    private $unitCode = '';
    private $unitDiscount;
    private $stockCardNumber;
    private $costCentre = '';
    private $contractNumber = '';
    private $rowSumType;
    private $totalWeight;
    private $subscriptionStart = null;
    private $totalVat;
    private $priceWithVat;

    /**
     * @param InvoiceItem $item
     * @return void
     */
    public function load(InvoiceItem $item)
    {
        //faktura id 
        $this->contractNumber = $item->polozka_id;
        $this->description = $item->popis_polozky;
        $this->subscriptionStart = $item->datum_realizacie;
        $this->unitCode = $item->merna_jednotka;
        $this->quanity = $item->mnozstvo;
        $this->unitPrice = $item->cena;
        //total cena
        $this->taxAmount = $item->dph;
        $this->priceWithVat = $item->cena_s_dph;
        $this->discountPercent = $item->pol_zlava_percent;

        return $this;
    }

    public function getRowTypes()
    {
        return [
            1 => Yii::t('app', 'Bežný'),
            2 => Yii::t('app', 'Odpočet záloh'),
            3 => Yii::t('app', 'ReverseCharge')
        ];
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getRowType(): int
    {
        return $this->rowType;
    }

    public function setRowType(int $rowType): void
    {
        $this->rowType = $rowType;
    }

    public function getTaxCode(): int
    {
        return $this->taxCode;
    }

    public function setTaxCode(int $taxCode): void
    {
        $this->taxCode = $taxCode;
    }

    public function getQuantity(): int
    {
        return $this->quanity;
    }

    public function setQuanity(int $quanity): void
    {
        $this->quanity = $quanity;
    }

    public function getUnitPrice(): float
    {
        return $this->unitPrice;
    }

    public function setUnitPrice(float $unitPrice): void
    {
        $this->unitPrice = $unitPrice;
    }

    public function getTaxPercent(): int
    {
        return $this->taxPercent;
    }

    public function setTaxPercent(int $taxPercent): void
    {
        $this->taxPercent = $taxPercent;
    }

    public function getTaxAmount(): int
    {
        return $this->taxAmount;
    }

    public function setTaxAmount(int $taxAmount): void
    {
        $this->taxAmount = $taxAmount;
    }

    public function getDiscountPercent(): int
    {
        return $this->discountPercent;
    }

    public function setDiscoundPercent(int $discountPercent): void
    {
        $this->discountPercent = $discountPercent;
    }

    public function getUnitDiscount(): int
    {
        return $this->unitDiscount;
    }

    public function setUnitDiscound(int $unitDiscount): void
    {
        $this->unitDiscount = $unitDiscount;
    }

    public function getStockCardNumber(): int
    {
        return $this->stockCardNumber;
    }

    public function setStockCardNumber(int $stockCardNumber): void
    {
        $this->stockCardNumber = $stockCardNumber;
    }

    public function getCostCentre(): string
    {
        return $this->costCentre;
    }

    public function setCostCentre(string $costCentre): void
    {
        $this->costCentre = $costCentre;
    }

    public function getContractNumber(): ?string
    {
        return $this->contractNumber;
    }

    public function setContranctNumber(string $contractNumber): void
    {
        $this->contractNumber = $contractNumber;
    }

    public function getRowSumType(): int
    {
        return $this->rowSumType;
    }

    public function setRowSumType(int $rowSumType): void
    {
        $this->rowSumType = $rowSumType;
    }

    public function getTotalWeight(): int
    {
        return $this->totalWeight;
    }

    public function setTotalWeight(int $totalWeight): void
    {
        $this->totalWeight = $totalWeight;
    }

    public function getSubscriptionStart()
    {
        return $this->subscriptionStart;
    }

    public function setSubscriptionStart($subscriptionStart)
    {
        $this->subscriptionStart = $subscriptionStart;
    }

    public function getUnitCode(): string
    {
        return $this->unitCode;
    }

    public function setUnitCode(string $unitCode): void
    {
        $this->unitCode = $unitCode;
    }

    public function getTotalVat(): ?float
    {
        return $this->totalVat;
    }

    public function setTotalVat(float $totalVat): void
    {
        $this->totalVat = $totalVat;
    }

    public function getPriceWithVat(): float
    {
        return $this->priceWithVat;
    }

    public function setPriceWithVat(float $priceWithVat): void
    {
        $this->priceWithVat = $priceWithVat;
    }
}
