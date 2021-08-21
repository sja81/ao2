<?php
namespace common\models\documents;

use backend\helpers\HelperString;
use common\models\CashReceipt;

class VPDDocument extends Documents
{
    private $docId;

    public function setId(int $id)
    {
        $this->docId = $id;
    }

    protected function getTemplateData()
    {
        $dok = CashReceipt::findOne($this->docId);

        $odberatelMeno = '';
        if (isset($dok->odberatel->nazov) && $dok->odberatel->nazov != '') {
            $odberatelMeno = $dok->odberatel->nazov;
        } elseif( isset($dok->odberatel->kontaktna_osoba) && $dok->odberatel->kontaktna_osoba != '') {
            $odberatelMeno = $dok->odberatel->kontaktna_osoba;
        }

        if ($dok->dodavatel->platca_dph == 1) {
            $sumar = $this->render('dph-sumar',[
                'doklad.suma'           => $dok->suma,
                'doklad.suma_dph'       => $dok->suma_s_dph - $dok->suma,
                'doklad.nepodlieha_dph' => $dok->suma_nepodlieha_dph,
                'doklad.mena'           => $dok->mena,
                'doklad.k_uhrade'       => $dok->suma_s_dph,
                'doklad.suma_text'      => HelperString::number2words($dok->suma_s_dph),
                'doklad.dph'            => $dok->dph,
            ]);
        } else {
            $sumar = $this->render('sumar',[
                'doklad.suma'       => $dok->suma,
                'doklad.mena'       => $dok->mena,
                'doklad.k_uhrade'   => $dok->suma,
                'doklad.suma_text'  => HelperString::number2words($dok->suma),
            ]);
        }

        $this->templateData = [
            'dodavatel.nazov'   => $dok->dodavatel->nazov,
            'dodavatel.ulica'   => $dok->dodavatel->ulica,
            'dodavatel.psc' => $dok->dodavatel->psc,
            'dodavatel.mesto'   => $dok->dodavatel->mesto,
            'dodavatel.stat'    => $dok->dodavatel->stat,
            'dodavatel.ico'     => $dok->dodavatel->ico,
            'dodavatel.dic'     => $dok->dodavatel->dic,
            'dodavatel.icdph'   => $dok->dodavatel->icdph,
            'doklad.cislo'      => $dok->cislo,
            'doklad.vyhotovil'  => $dok->vyhotovil,
            'doklad.schvalil'   => $dok->schvalil,
            'doklad.zo_dna'     => (new \DateTime($dok->vystavene))->format("d.m.Y"),
            'doklad.ucel'       => $dok->ucel,
            'odberatel.meno'    => $odberatelMeno,
            'odberatel.ulica'   => $dok->odberatel->ulica,
            'odberatel.psc'     => $dok->odberatel->psc,
            'odberatel.mesto'   => $dok->odberatel->mesto,
            'odberatel.ico'     => $dok->odberatel->ico,
            'odberatel.dic'     => $dok->odberatel->dic,
            'odberatel.icdph'   => $dok->odberatel->icdph,
            'doklad.sumar'      => $sumar,
        ];
    }
}