<?php
namespace common\models\documents;

use Yii;

class SuhlasOsobneUdajeDocument extends Documents implements IContractDocument
{
    private $contractNumber = null;
    private $poradie;

    public function setContractNumber($number)
    {
        $this->contractNumber = $number;
    }

    public function setPoradie(int $poradie)
    {
        $this->poradie = $poradie;
    }

    protected function getTemplateData()
    {
        $customers = Yii::$app
            ->db
            ->createCommand("
                    SELECT
                        c.email, c.name_first, c.name_last, c.phone
                    FROM
                        customer c
                    JOIN
                        zmluva_zakaznik zz ON zz.zakaznik_id=c.id
                    JOIN
                        zmluva z ON zz.zmluva_id=z.id
                    WHERE
                        z.cislo = :cid")
            ->bindValue(":cid", $this->contractNumber)
            ->queryAll();

        $this->templateData = [
            'popis_poziadavky'      => '',
            'titul'                 => '',
            'meno'                  => $customers[$this->poradie-1]['name_first'],
            'priezvisko'            => $customers[$this->poradie-1]['name_last'],
            'email'                 => $customers[$this->poradie-1]['email'],
            'telefon'               => str_replace(","," ", $customers[$this->poradie-1]['phone']),
            'druh_nehnutelnosti'    => '',
            'datum'                 => $this->getDate(),
            'mesto'                 => $this->getPodpisMiesto()
        ];
    }

    public function create()
    {
        parent::create();
        $this->writeToFile($this->contractNumber);
        $this->writeToDatabase($this->contractNumber, DocType::SUHLAS_OSOBNE_UDAJE, $this->poradie);
    }
}