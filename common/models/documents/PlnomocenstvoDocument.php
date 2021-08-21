<?php
namespace common\models\documents;

class PlnomocenstvoDocument extends Documents implements IContractDocument
{
    private $contractNumber = null;

    public function setContractNumber($number)
    {
        $this->contractNumber = $number;
    }

    protected function getTemplateData()
    {
        $this->templateData = [
            "sluzba.voda"   => "",
            "sluzba.elektrina"  => "",
            "sluzba.plyn"   => "",
            "sluzba.olo"    => "",
        ];
    }

    public function create()
    {
        parent::create();
        $this->writeToFile($this->contractNumber);
        $this->writeToDatabase($this->contractNumber, DocType::PLNOMOCENSTVO);
    }
}