<?php

namespace common\models\mrp\xmlgenerator;

use Yii;
use common\models\Invoice;

class InvoiceInfo
{
    private $documentNumber = '';
    private $issueDate = null;
    private $currencyCode = '';
    private $valuesWithTax = true;
    private $taxCode;
    private $zeroTaxRateAmount;
    private $baseTaxRateAmount;
    private $roundingAmount;
    private $reducedTaxRateTax;
    private $baseTaxRateTax;
    private $totalWithTaxCurr;
    private $taxPointDate = null;
    private $doubleEntryBookkeepingCode;
    private $singleEntryBookkeepingCode;
    private $singleEntryBookkeepingSubCode;
    private $controlStatementLeasing = null;
    private $totalWeight;
    private $costCentre = '';
    private $contractNumber = '';
    private $vatRegime;
    private $vatCountry = '';
    private $eurExchangeRate;
    private $eurExchangeRateAmount;
    private $calcParams = '';
    private $variableSymbol = '';
    private $constantSymbol = '';
    private $paymentDueDate = null;
    private $currRateAmount;
    private $currRate;
    private $paidAmount;
    private $paidAmountCurr;
    private $invoiceType = '';
    private $paymentMeansCode = '';
    private $note = '';
    private $deliveryDate = null;
    private $paidAmountDph;
    private $discount;
    private $amountToPay;
    private $transferredTax;
    private $zaloha;
    /**
     * @param Invoice $invoice
     * @return void
     */
    public function load(Invoice $invoice)
    {
        $this->documentNumber = $invoice->znak . $invoice->rok . $invoice->mesiac . $invoice->cislo;
        $this->contractNumber = $invoice->zmluva_id;
        $this->note = $invoice->poznamka;
        $this->issueDate = $invoice->datum_vystavenia;
        $this->deliveryDate = $invoice->datum_dodania;
        $this->paymentDueDate = $invoice->splatnost;
        $this->currencyCode = $invoice->mena;
        $this->eurExchangeRate = $invoice->kurz_meny;
        $this->discount = $invoice->zlava;
        $this->paymentMeansCode = $invoice->forma_uhrady;
        $this->invoiceType = $invoice->typ_faktury;
        $this->paidAmount = $invoice->suma;
        $this->paidAmountDph = $invoice->suma_s_dph;
        $this->amountToPay = $invoice->k_uhrade;
        $this->variableSymbol = $invoice->var_symbol;
        $this->constantSymbol = $invoice->konst_symbol;
        $this->transferredTax = $invoice->prenesena_dan;
        $this->zaloha = $invoice->zaloha;

        return $this;
    }

    public function getInvoiceTypes(): array
    {
        return [
            "F" => Yii::t('app', 'Bežná'),
            "X" => Yii::t('app', 'Predfaktúra'),
            "P" => Yii::t('app', 'Penalizačná')
        ];
    }

    public function getValuesWithTaxTypes(): array
    {
        return [
            "T" => Yii::t('app', 'Cena s DPH'),
            "F" => Yii::t('app', 'Cena bez DPH'),
        ];
    }

    public function getDocumentNumber(): string
    {
        return $this->documentNumber;
    }

    /**
     * @param string $documentNumber
     */
    public function setDocumentNumber(string $documentNumber): void
    {
        $this->documentNumber = $documentNumber;
    }

    public function getIssueDate(): string
    {
        return $this->issueDate ?? (new \DateTime('now'))->format('Y-m-d H:i:s');
    }

    /**
     * @param string $issueDate
     * @return void
     */
    public function setIssueDate(string $issueDate): void
    {
        $this->issueDate = $issueDate;
    }

    public function getCurrencyCode(): string
    {
        return $this->currencyCode;
    }

    /**
     * @param string $currencyCode
     */
    public function setCurrencyCode(string $currencyCode): void
    {
        $this->currencyCode = $currencyCode;
    }

    public function getValuesWithTax()
    {
        return $this->valuesWithTax;
    }

    /**
     * @param string $valuesWithTax
     */
    public function setValuesWithTax($valuesWithTax): void
    {
        $this->valuesWithTax = $valuesWithTax;
    }

    public function getTaxCode()
    {
        return $this->taxCode;
    }

    /**
     * @param string $taxCode
     */
    public function setTaxCode(int $taxCode): void
    {
        $this->taxCode = $taxCode;
    }

    public function getZeroTaxRateAmount()
    {
        return $this->zeroTaxRateAmount;
    }

    public function setZeroTaxRateAmount(int $zeroTaxRateAmount): void
    {
        $this->zeroTaxRateAmount = $zeroTaxRateAmount;
    }

    public function getReducedTaxRateAmount()
    {
        return $this->reducedTaxRateAmount;
    }

    public function setReducedTaxRateAmount(int $reducedTaxRateAmount): void
    {
        $this->reducedTaxRateAmount = $reducedTaxRateAmount;
    }

    public function getBaseTaxRateAmount()
    {
        return $this->baseTaxRateAmount;
    }

    public function setBaseTaxRateAmount(int $baseTaxRateAmount): void
    {
        $this->baseTaxRateAmount = $baseTaxRateAmount;
    }

    public function getRoundingAmount()
    {
        return $this->roundingAmount;
    }

    public function setRoundingAmount(int $roundingAmount): void
    {
        $this->roundingAmount = $roundingAmount;
    }

    public function getReducedTaxRateTax()
    {
        return $this->reducedTaxRateTax;
    }

    public function setReducedTaxRateTax(int $reducedTaxRateTax): void
    {
        $this->reducedTaxRateTax = $reducedTaxRateTax;
    }

    public function getBaseTaxRateTax()
    {
        return $this->baseTaxRateTax;
    }

    public function setBaseTaxRateTax(int $baseTaxRateTax): void
    {
        $this->baseTaxRateTax = $baseTaxRateTax;
    }

    public function getTotalWithTaxCurr()
    {
        return $this->totalWithTaxCurr;
    }

    public function setTotalWithTaxCurr(int $totalWithTaxCurr): void
    {
        $this->totalWithTaxCurr = $totalWithTaxCurr;
    }

    public function getTaxPointDate()
    {
        return $this->taxPointDate;
    }

    public function setTaxPointDate(int $taxPointDate): void
    {
        $this->taxPointDate = $taxPointDate;
    }

    public function getDoubleEntryBookkeepingCode()
    {
        return $this->doubleEntryBookkeepingCode;
    }

    public function setDoubleEntryBookkeepingCode(int $doubleEntryBookkeepingCode): void
    {
        $this->doubleEntryBookkeepingCode = $doubleEntryBookkeepingCode;
    }

    public function getSingleEntryBookkeepingCode()
    {
        return $this->singleEntryBookkeepingCode;
    }

    public function setSingleEntryBookkeepingCode(int $singleEntryBookkeepingCode): void
    {
        $this->singleEntryBookkeepingCode = $singleEntryBookkeepingCode;
    }

    public function getSingleEntryBookkeepingSubCode()
    {
        return $this->singleEntryBookkeepingSubCode;
    }

    public function setSingleEntryBookkeepingSubCode(int $singleEntryBookkeepingSubCode): void
    {
        $this->SingleEntryBookkeepingSubCode = $singleEntryBookkeepingSubCode;
    }

    public function getControlStatementLeasing()
    {
        return $this->controlStatementLeasing;
    }

    public function setControlStatementLeasing($controlStatementLeasing): void
    {
        $this->controlStatementLeasing = $controlStatementLeasing;
    }

    public function getTotalWeight()
    {
        return $this->totalWeight;
    }

    public function setTotalWeight(int $totalWeight): void
    {
        $this->totalWeight = $totalWeight;
    }

    public function getCostCentre()
    {
        return $this->costCentre;
    }

    public function setCostCentre(int $costCentre): void
    {
        $this->costCentre = $costCentre;
    }

    public function getContractNumber()
    {
        return $this->contractNumber;
    }

    public function setContractNumber(int $contractNumber): void
    {
        $this->contractNumber = $contractNumber;
    }

    public function getVatRegime()
    {
        return $this->vatRegime;
    }

    public function setVatRegime(int $vatRegime): void
    {
        $this->vatRegime = $vatRegime;
    }

    public function getVatCountry()
    {
        return $this->vatCountry;
    }

    public function setVatCountry(string $vatCountry): void
    {
        $this->vatCountry = $vatCountry;
    }
    public function getEurExchangeRate()
    {
        return $this->eurExchangeRate;
    }

    public function setEurExchangeRate(int $eurExchangeRate): void
    {
        $this->eurExchangeRate = $eurExchangeRate;
    }
    public function getEurExchangeRateAmount()
    {
        return $this->eurExchangeRateAmount;
    }

    public function setEurExchangeRateAmount(int $eurExchangeRateAmount): void
    {
        $this->eurExchangeRateAmount = $eurExchangeRateAmount;
    }
    public function getCalcParams()
    {
        return $this->calcParams;
    }

    public function setCalcParams(int $calcParams): void
    {
        $this->calcParams = $calcParams;
    }

    public function getVariableSymbol()
    {
        return $this->variableSymbol;
    }

    public function setVariableSymbol(int $variableSymbol): void
    {
        $this->variableSymbol = $variableSymbol;
    }
    public function getConstantSymbol()
    {
        return $this->constantSymbol;
    }

    public function setConstantSymbol(int $constantSymbol): void
    {
        $this->constantSymbol = $constantSymbol;
    }
    public function getPaymentDueDate()
    {
        return $this->paymentDueDate;
    }

    public function setPaymentDueDate($paymentDueDate): void
    {
        $this->paymentDueDate = $paymentDueDate;
    }
    public function getCurrRateAmount()
    {
        return $this->currRateAmount;
    }

    public function setCurrRateAmount(int $currRateAmount): void
    {
        $this->currRateAmount = $currRateAmount;
    }

    public function getCurrRate()
    {
        return $this->currRate;
    }

    public function setCurrRate(int $currRate): void
    {
        $this->currRate = $currRate;
    }
    public function getPaidAmount(): float
    {
        return $this->paidAmount;
    }

    public function setPaidAmount(float $paidAmount): void
    {
        $this->paidAmount = $paidAmount;
    }
    public function getPaidAmountCurr()
    {
        return $this->paidAmountCurr;
    }

    public function setPaidAmountCurr(int $paidAmountCurr): void
    {
        $this->paidAmountCurr = $paidAmountCurr;
    }
    public function getInvoiceType()
    {
        return $this->invoiceType;
    }

    public function setInvoiceType(string $invoiceType): void
    {
        $this->invoiceType = $invoiceType;
    }

    public function getPaymentMeansCode()
    {
        return $this->paymentMeansCode;
    }

    public function setPaymentMeansCode(string $paymentMeansCode): void
    {
        $this->paymentMeansCode = $paymentMeansCode;
    }

    public function getDiscount()
    {
        return $this->discount;
    }

    public function setDiscount(int $discount): void
    {
        $this->discount = $discount;
    }

    public function getNote(): string
    {
        return $this->note;
    }

    public function setNote(string $note): void
    {
        $this->note = $note;
    }

    public function getDeliveryDate()
    {
        return $this->deliveryDate;
    }
    public function setDeliveryDate($deliveryDate)
    {
        $this->deliveryDate = $deliveryDate;
    }

    public function getPaidAmountDph(): float
    {
        return $this->paidAmountDph;
    }

    public function setPaidAmountDph(float $paidAmountDph): void
    {
        $this->paidAmountDph = $paidAmountDph;
    }

    public function getAmountToPay(): int
    {
        return $this->amountToPay;
    }

    public function setAmountToPay(int $amountToPay): void
    {
        $this->amountToPay = $amountToPay;
    }

    public function getTransferredTax(): int
    {
        return $this->transferredTax;
    }

    public function setTransfeerreTax(int $transferredTax): void
    {
        $this->transferredTax = $transferredTax;
    }

    public function getZaloha(): ?int
    {
        return $this->zaloha;
    }

    public function setZaloha(int $zaloha): void
    {
        $this->zaloha = $zaloha;
    }
}
