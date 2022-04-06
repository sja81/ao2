<?php

namespace common\models\mrp\xmlgenerator;

use Yii;

class Payments
{
    private $paymentType;
    private $paymentDate = null;
    private $documentNumber = '';
    private $amount = '';
    private $amountCurr;
    private $amountPaidDocumentCurr;
    private $currencyCode = '';
    private $currRate;
    private $currRateAmount;

    public static function getPaymentMethods(): array
    {
        return [
            0   =>  Yii::t('app', 'Neuvedené'),
            1   =>  Yii::t('app', 'Bankový prevod'),
            2   =>  Yii::t('app', 'Pokladna'),
            3   =>  Yii::t('app', 'Kurzový rozdiel'),
            4  =>  Yii::t('app', 'Zápočet'),
            5  =>  Yii::t('app', 'Interný doklad')
        ];
    }

    public function getPaymentType(): int
    {
        return $this->paymentType;
    }

    public function setPaymentType(int $paymentType): void
    {
        $this->paymentType = $paymentType;
    }

    public function getPaymentDate()
    {
        return $this->paymentDate;
    }

    public function setPaymentDate($paymentDate): void
    {
        $this->paymentDate = $paymentDate;
    }

    public function getDocumentNumber(): string
    {
        return $this->documentNumber;
    }

    public function setDocumentNumber(string $documentNumber): void
    {
        $this->documentNumber = $documentNumber;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): void
    {
        $this->amount = $amount;
    }

    public function getAmountCurr(): int
    {
        return $this->amountCurr;
    }

    public function setAmountCurr(int $amountCurr): void
    {
        $this->amountCurr = $amountCurr;
    }

    public function getAmountPaidDocumentCurr(): int
    {
        return $this->amountPaidDocumentCurr;
    }

    public function setAmountPaidDocumentCurr(int $amountPaidDocumentCurr): void
    {
        $this->amountPaidDocumentCurr = $amountPaidDocumentCurr;
    }

    public function getCurrencyCode(): string
    {
        return $this->currencyCode;
    }

    public function setCurrencyCode(string $currencyCode): void
    {
        $this->currencyCode = $currencyCode;
    }

    public function getCurrRate(): int
    {
        return $this->currRate;
    }
    public function setCurrRate(int $currRate): void
    {
        $this->currRate = $currRate;
    }
    public function getCurrRateAmount(): int
    {
        return $this->currRateAmount;
    }
    public function setCurrRateAmount(int $currRateAmount): void
    {
        $this->currRateAmount = $currRateAmount;
    }
}
