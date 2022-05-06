<?php
namespace common\models\posta\slovensko\eph\xmlgenerator;

use Yii;

class EphInfo
{
    private $id;
    private $currency = 'EUR';
    private $ephType = 1;

    /**
     * @var null|EphSender instance of EphSender or null
     */
    private $sender = null;

    private $date = null;
    private $dateFormat = 'Ymd';
    private $paymentType;
    private $shipmentType;
    private $processType = 3;

    const EPH_TYPE_EPH = 1;

    const PYM_BANK_TRANSFER = 3;
    const PYM_STAMPS = 4;
    const PYM_CASH = 5;
    const PYM_INVOICE = 8;
    const PYM_CARD = 9;

    const SHIP_REGISTERED_LETTER = 1; // doporuceny list
    const SHIP_INSURRED_LETTER = 2;
    const SHIP_PACKAGE = 4;
    const SHIP_LETTER = 30;
    const SHIP_SMALL_PACKAGE = 33;

    const PROC_POST_OFFICE = 3;

    public static function getPaymentMethods(): array
    {
        return [
            3   =>  Yii::t('app','Prevodom'),
            4   =>  Yii::t('app','Poštové známky'),
            5   =>  Yii::t('app','Platené v hotovosti'),
            8   =>  Yii::t('app','Faktúra'),
            9   =>  Yii::t('app','Online (platba kartou)')
        ];
    }

    public static function getShipmentMethods(): array
    {
        return [
            1   =>  Yii::t('app','Doporučený list'),
            2   =>  Yii::t('app','Poistený list'),
            4   =>  Yii::t('app','Balík'),
            30  =>  Yii::t('app','List'),
            33  =>  Yii::t('app','Balíček')
        ];
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getProcessType(): int
    {
        return $this->processType;
    }

    /**
     * @param int $processType
     */
    public function setProcessType(int $processType): void
    {
        $this->processType = $processType;
    }

    /**
     * @return mixed
     */
    public function getShipmentType()
    {
        return $this->shipmentType;
    }

    /**
     * @param mixed $shipmentType
     */
    public function setShipmentType($shipmentType): void
    {
        $this->shipmentType = $shipmentType;
    }

    /**
     * @return mixed
     */
    public function getPaymentType()
    {
        return $this->paymentType;
    }

    /**
     * @param mixed $paymentType
     */
    public function setPaymentType($paymentType): void
    {
        $this->paymentType = $paymentType;
    }

    /**
     * @return string
     */
    public function getDateFormat(): string
    {
        return $this->dateFormat;
    }

    /**
     * @param string $dateFormat
     */
    public function setDateFormat(string $dateFormat): void
    {
        $this->dateFormat = $dateFormat;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     */
    public function setCurrency(string $currency): void
    {
        $this->currency = $currency;
    }

    /**
     * @return int
     */
    public function getEphType(): int
    {
        return $this->ephType;
    }

    /**
     * @param int $ephType
     */
    public function setEphType(int $ephType): void
    {
        $this->ephType = $ephType;
    }

    /**
     * @return null
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * @param null $sender
     */
    public function setSender($sender): void
    {
        $this->sender = $sender;
    }

    /**
     * @return null
     */
    public function getDate()
    {
        return $this->date ?? (new \DateTimeImmutable('now'))->format($this->getDateFormat());
    }

    /**
     * @param null $date
     */
    public function setDate($date): void
    {
        $this->date = $date;
    }


}