<?php
namespace common\models\posta\slovensko\eph\xmlgenerator;

use Yii;

class EphShipment
{
    private $recipient = null;
    private $weight = 0;
    private $letterClass='';
    private $content='';
    private $services=[];
    private $sameReturnAddress = true;

    public static function getAvailableServices(): array
    {
        return [
            'D'     =>  Yii::t('app','Doručenka'),
            'DO1'   =>  Yii::t('app','Doručenie do hodiny v meste'),
            'DO1M'  =>  Yii::t('app','Doručenie do hodiny mimo mesta'),
            'DDP'   =>  Yii::t('app','Doručiť v deň podania'),
            'DOH'   =>  Yii::t('app','Doručiť do 10:00'),
            'DSH'   =>  Yii::t('app','Doručiť do 14:00'),
            'DSO'   =>  Yii::t('app','Doručiť aj v sobotu'),
            'F'     =>  Yii::t('app','Krehké'),
            'IOD'   =>  Yii::t('app','Info o doručení'),
            'NDO'   =>  Yii::t('app','Nedoposielať'),
            'NEU'   =>  Yii::t('app','Neukladať'),
            'NEV'   =>  Yii::t('app','Nevrátiť'),
            'NSK'   =>  Yii::t('app','Neskladné'),
            'OD'    =>  Yii::t('app','Opakované doručenie na žiadosť odosielateľa'),
            'OS'    =>  Yii::t('app','Odpovedná služba'),
            'PR'    =>  Yii::t('app','Na poštu'),
            'PUZ'   =>  Yii::t('app','Podaj u kuriéra'),
            'SV'    =>  Yii::t('app','Splnomocnenie vylúčené'),
            'SVD'   =>  Yii::t('app','Spätné vrátenie potvrdenej dokumentácie'),
            'VR'    =>  Yii::t('app','Do vlastných rúk'),
            'VT'    =>  Yii::t('app','Výmena tovaru'),
            ];
    }

    /**
     * @return int
     */
    public function getWeight(): int
    {
        return $this->weight;
    }

    /**
     * @param int $weight
     */
    public function setWeight(int $weight): void
    {
        $this->weight = $weight;
    }

    /**
     * @return string
     */
    public function getLetterClass(): string
    {
        return $this->letterClass;
    }

    /**
     * @param string $letterClass
     */
    public function setLetterClass(string $letterClass): void
    {
        $this->letterClass = $letterClass;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content): void
    {
        $this->content = $content;
    }

    /**
     * @return array
     */
    public function getServices(): array
    {
        return $this->services;
    }

    /**
     * @param array $services
     */
    public function setServices(array $services): void
    {
        $this->services = $services;
    }

    /**
     * @return bool
     */
    public function isSameReturnAddress(): bool
    {
        return $this->sameReturnAddress;
    }

    /**
     * @param bool $sameReturnAddress
     */
    public function setSameReturnAddress(bool $sameReturnAddress): void
    {
        $this->sameReturnAddress = $sameReturnAddress;
    }

    /**
     * @return array array of EphRecipient objects
     */
    public function getRecipient(): EphRecipient
    {
        return $this->recipient;
    }

    /**
     * @param null $recipient
     */
    public function setRecipient($recipient): void
    {
        $this->recipient = $recipient;
    }

}