<?php
namespace common\models;

use Yii;

class Accounting
{
    private $invoiceData = [];
    private $odberatelData = [];
    private $dodavatelData = [];
    private $polozkyData = [];
    private $receiptData = [];

    public function setInvoiceData (array $data)
    {
        $this->invoiceData = $data;
    }

    public function setOdberatelData (array $data)
    {
        $this->odberatelData = $data;
    }

    public function setDodavatelData (array $data)
    {
        $this->dodavatelData = $data;
    }

    public function setPolozkyData(array $data)
    {
        $this->polozkyData = $data;
    }

    public function buildInvoice(Invoice $invoice = null)
    {
        if (is_null($invoice)) {
            $invoice = new Invoice();
            $invoice->created_at = (new \DateTime('now'))->format('Y-m-d H:i:s');
            $invoice->status = Invoice::PENDING;
            $invoice->created_by = Yii::$app->user->identity->getId();
        }

        $this->invoiceData['mesiac'] = 0;
        if (strlen($this->invoiceData['cislo_faktury']) == 14) {
            $this->invoiceData['mesiac'] = substr($this->invoiceData['cislo_faktury'],8,2);
        }
        $this->invoiceData['znak'] = substr($this->invoiceData['cislo_faktury'],0,4);
        $this->invoiceData['rok'] = substr($this->invoiceData['cislo_faktury'],4,4);
        $this->invoiceData['cislo'] = substr($this->invoiceData['cislo_faktury'],strlen($this->invoiceData['cislo_faktury'])-4,4);

        $this->makeInvoice($invoice);

        $dodavatel = InvoiceSupplier::findOne(['faktura_id'=>$invoice->id]);
        if (!$dodavatel) {
            $dodavatel = new InvoiceSupplier();
            $dodavatel->status = 1;
            $dodavatel->faktura_id = $invoice->id;
        }

        $this->makeInvoiceSupplier($dodavatel);

        $odberatel = InvoiceCustomer::findOne(['faktura_id'=>$invoice->id]);
        if (!$odberatel) {
            $odberatel = new InvoiceCustomer();
            $odberatel->status=1;
            $odberatel->faktura_id = $invoice->id;
        }

        $this->makeInvoiceCustomer($odberatel);

        $this->makeInvoiceItems($invoice);
    }

    private function makeInvoice(Invoice $invoice)
    {
        $attributes = $invoice->getAttributes();
        foreach($attributes as $attr => $value) {
            if (in_array($attr,[
                'id',
                'kurz_meny',
                'status',
                'created_at',
                'created_by',
                'reated_by',
                'qr_kod'
            ])) {
                continue;
            }

            if ( $invoice->isNewRecord ||
                (!$invoice->isNewRecord && isset($this->invoiceData[$attr]) && $this->invoiceData[$attr] != $value )
            ) {
                if ($attr == 'prenesena_dan') {
                    $invoice->$attr = isset($this->invoiceData['prenesena_dan']) ? $this->invoiceData['prenesena_dan'] : 0;
                } elseif($attr == 'peciatka') {
                    $invoice->$attr = isset($this->invoiceData['peciatka']) ? $this->invoiceData['peciatka'] : 0;
                }else {
                    $invoice->$attr = $this->invoiceData[$attr];
                }

            }

        }

        $result = $invoice->save();
        if (!$result) {
            throw new Exception('Faktura nebola ulozena - faktura!',401);
        }
    }

    private function makeInvoiceSupplier(InvoiceSupplier $dodavtel)
    {
        $attributes = $dodavtel->getAttributes();
        foreach($attributes as $attr => $value) {
            if (in_array($attr,[
                'id',
                'faktura_id',
                'status'
            ])) {
                continue;
            }
            if ( $dodavtel->isNewRecord ||
                (!$dodavtel->isNewRecord && isset($this->dodavatelData[$attr]) && $this->dodavatelData[$attr] != $value )
            ) {
                if ($attr == 'mesto') {
                    $mesto = json_decode($this->dodavatelData['mesto'],true);
                    $dodavtel->$attr = $mesto['nazov_obce'];
                } else {
                    $dodavtel->$attr = $this->dodavatelData[$attr];
                }
            }
        }
        $result = $dodavtel->save();
        if (!$result) {
            throw new Exception('Faktura nebola ulozena - dodavatel!',401);
        }
    }

    private function makeInvoiceCustomer(InvoiceCustomer $customer)
    {
        $attributes = $customer->getAttributes();
        foreach($attributes as $attr => $value) {
            if (in_array($attr,[
                'id',
                'faktura_id',
                'status'
            ])) {
                continue;
            }
            if ( $customer->isNewRecord ||
                (!$customer->isNewRecord && isset($this->odberatelData[$attr]) && $this->odberatelData[$attr] != $value )
            ) {
                if ($attr == 'mesto') {
                    $customer->$attr = json_decode($this->odberatelData['mesto'],true)['nazov_obce'];
                } elseif ($attr == 'dodacia_mesto') {
                    $customer->$attr = $this->odberatelData['dodacia_mesto'] != '' ? json_decode($this->odberatelData['dodacia_mesto'],true)['nazov_obce'] : null;
                } else {
                    $customer->$attr = $this->odberatelData[$attr];
                }
            }
        }
        $result = $customer->save();
        if (!$result) {
            throw new Exception('Faktura nebola ulozena - odberatel!',401);
        }
    }

    private function makeInvoiceItems(Invoice $invoice)
    {
        $attributes = [];
        foreach($this->polozkyData as $id => $it) {
            if (isset($it['id']) && (int)$it['id'] > 0) {
                $polozka = InvoiceItem::findOne(['id'=>$it['id']]);
            } else {
                $polozka = new InvoiceItem();
                $polozka->status=1;
                $polozka->faktura_id=$invoice->id;
            }
            if (empty($attributes)) {
                $attributes = $polozka->getAttributes();
            }

            foreach($attributes as $attr => $value) {
                if (in_array($attr,[
                    'id',
                    'faktura_id',
                    'polozka_text',
                    'status'
                ])) {
                    continue;
                }
                if ( $polozka->isNewRecord ||
                    (!$polozka->isNewRecord && isset($it[$attr]) && $it[$attr] != $value )
                ) {
                    if ($attr == "polozka_id") {

                        $polozkaId=null;
                        if (isset($it[$attr]) && $it[$attr] != '') {
                            $polozkaId = json_decode($it[$attr],true);
                            $polozkaId = $polozkaId['id'];
                        }
                        $polozka->$attr = $polozkaId;
                    } else {
                        $polozka->$attr = isset($it[$attr]) ? $it[$attr] : null;
                    }
                }
            }
            $polozkaArray = [];
            if (isset($it['polozka_id']) && $it['polozka_id'] != '') {
                if (strpos($polozkaId,'bal_') !== false) {
                    $polozkaId = str_replace('bal_','',$polozkaId);
                    $polozkaArray[] = (Baliky::findOne(['id'=>$polozkaId]))->nazov;
                } else {
                    $polozkaArray[] = (Sluzby::findOne(['id'=>$polozkaId]))->nazov;
                }
            }
            if (isset($it['popis_polozky']) && $it['popis_polozky'] != '') {
                $polozkaArray[] = $it['popis_polozky'];
            }
            if (isset($it['datum_realizacie']) && $it['datum_realizacie']) {
                $polozkaArray[] = $it['datum_realizacie'];
            }
            $polozka->polozka_text = implode(' - ', $polozkaArray);
            $result = $polozka->save();
            if (!$result) {
                throw new Exception('Faktura nebola ulozena - polozka!',401);
            }
        }
    }

    public function getNextInvoiceNumber(Office $office)
    {
        return $office->invoice_sign . $this->getVariabilnySymbol($office);
    }

    public function getVariabilnySymbol(Office $office)
    {
        $year = (new \DateTime('now'))->format('Y');
        $month = "";
        // TODO: meg kell beszelni!!!
        /*if ($office->vat_payer == 1) {
            $month = ' and mesiac=' . (new \DateTime('now'))->format('m');
        }*/
        $number = Yii::$app->db->createCommand("
                select
                    cislo
                from
                    faktura 
                where
                    rok={$year} and znak='{$office->invoice_sign}'{$month}
                order by
                    id desc
            ")->queryScalar();
        $number = !$number ? 0 : $number;
        $signLength = strlen($office->invoice_sign);
        return $year . $month . str_pad($number + 1,$signLength, 0,STR_PAD_LEFT);
    }

    /*
     * Cash receipt part
     */

    public function setReceiptData(array $data)
    {
        $this->receiptData = $data;
    }

    public function updateReceipt()
    {
        $receipt = CashReceipt::findOne(['id'=>$this->receiptData['id']]);
        $receipt->pp_typ = $this->receiptData['typ'];
        $receipt->vystavene = $this->receiptData['vystavene'];
        $receipt->status = CashReceipt::PENDING;
        $receipt->cislo = $this->receiptData['cislo'];
        $receipt->ucel = $this->receiptData['ucel'];
        $receipt->vyhotovil = $this->receiptData['vyhotovil'];
        $receipt->schvalil = $this->receiptData['schvalil'];
        $receipt->zuctovane = $this->receiptData['zuctovane'];
        $receipt->mena = $this->receiptData['mena'];
        $receipt->mena_kurz = 0;
        $receipt->suma = $this->receiptData['suma'];
        $receipt->dph = ($this->receiptData['platca_dph'] == 0) ? 0 : $this->receiptData['dph'];
        $receipt->suma_s_dph = ($this->receiptData['platca_dph'] == 0) ? 0 : $this->receiptData['suma2'];
        $receipt->suma_nepodlieha_dph = ($this->receiptData['platca_dph'] == 0) ? 0 : $this->receiptData['suma_nepodlieha_dph'];
        $receipt->updated_by = Yii::$app->user->identity->id;
        $receipt->updated_at = (new \DateTime('now'))->format('Y-m-d H:i:s');

        $result = $receipt->save();
        if (!$result) {
            throw new Exception('PD nebola ulozena!',401);
        }

        $dodav = CashReceiptSupplier::findOne(['doklad_id'=>$this->receiptData['id']]);
        $dodav->doklad_id = $this->receiptData['id'];
        $dodav->ico = $this->receiptData['dodavatel']['ico'];
        $dodav->dic = $this->receiptData['dodavatel']['dic'];
        $dodav->icdph = $this->receiptData['dodavatel']['icdph'];
        $dodav->stat = $this->receiptData['dodavatel']['country'];
        $dodav->nazov = $this->receiptData['dodavatel']['name'];
        $dodav->ulica = $this->receiptData['dodavatel']['address'];
        $dodav->psc = $this->receiptData['dodavatel']['zip'];
        $dodav->platca_dph = $this->receiptData['platca_dph'];
        $dodav->mesto = (json_decode($this->receiptData['dodavatel']['town'],TRUE))['nazov_obce'];
        $dodav->updated_by = Yii::$app->user->identity->id;
        $dodav->updated_at = (new \DateTime('now'))->format('Y-m-d H:i:s');

        $result = $dodav->save();
        if (!$result) {
            throw new Exception('PD nebola ulozena - dodavatel!',401);
        }

        $odber = CashReceiptCustomer::findOne(['doklad_id'=>$this->receiptData['id']]);
        $odber->doklad_id = $this->receiptData['id'];
        $odber->nazov = $this->receiptData['odberatel']['name'];
        $odber->kontaktna_osoba = $this->receiptData['odberatel']['contact_person'];
        $odber->ulica = $this->receiptData['odberatel']['address'];
        $odber->psc = $this->receiptData['odberatel']['zip'];
        $odber->stat = $this->receiptData['odberatel']['country'];
        $odber->ico = $this->receiptData['odberatel']['ico'];
        $odber->dic = $this->receiptData['odberatel']['dic'];
        $odber->icdph = $this->receiptData['odberatel']['icdph'];
        $odber->mesto = (json_decode($this->receiptData['odberatel']['town'],TRUE))['nazov_obce'];
        $odber->updated_by = Yii::$app->user->identity->id;
        $odber->updated_at = (new \DateTime('now'))->format('Y-m-d H:i:s');

        $result = $odber->save();
        if (!$result) {
            throw new Exception('PD nebola ulozena - odberatel!',401);
        }

    }

    public function createReceipt()
    {
        // create a record in pokladnicny_doklad table
        $receipt = new CashReceipt();
        $receipt->pp_typ = $this->receiptData['typ'];
        $receipt->vystavene = $this->receiptData['vystavene'];
        $receipt->status = CashReceipt::PENDING;
        $receipt->cislo = $this->receiptData['cislo'];
        $receipt->ucel = $this->receiptData['ucel'];
        $receipt->vyhotovil = $this->receiptData['vyhotovil'];
        $receipt->schvalil = $this->receiptData['schvalil'];
        $receipt->zuctovane = $this->receiptData['zuctovane'];
        $receipt->mena = $this->receiptData['mena'];
        $receipt->mena_kurz = 0;
        $receipt->suma = $this->receiptData['suma'];
        $receipt->dph = ($this->receiptData['platca_dph'] == 0) ? 0 : $this->receiptData['dph'];
        $receipt->suma_s_dph = ($this->receiptData['platca_dph'] == 0) ? 0 : $this->receiptData['suma2'];
        $receipt->suma_nepodlieha_dph = ($this->receiptData['platca_dph'] == 0) ? 0 : $this->receiptData['suma_nepodlieha_dph'];
        $receipt->created_by = Yii::$app->user->identity->id;
        $receipt->created_at = (new \DateTime('now'))->format('Y-m-d H:i:s');

        $result = $receipt->save();
        if (!$result) {
            throw new Exception('PD nebola ulozena!',401);
        }

        $dodav = new CashReceiptSupplier();
        $dodav->doklad_id = $receipt->id;
        $dodav->ico = $this->receiptData['dodavatel']['ico'];
        $dodav->dic = $this->receiptData['dodavatel']['dic'];
        $dodav->icdph = $this->receiptData['dodavatel']['icdph'];
        $dodav->stat = $this->receiptData['dodavatel']['country'];
        $dodav->nazov = $this->receiptData['dodavatel']['name'];
        $dodav->ulica = $this->receiptData['dodavatel']['address'];
        $dodav->psc = $this->receiptData['dodavatel']['zip'];
        $dodav->platca_dph = $this->receiptData['platca_dph'];
        $dodav->mesto = (json_decode($this->receiptData['dodavatel']['town'],TRUE))['nazov_obce'];
        $dodav->created_by = Yii::$app->user->identity->id;
        $dodav->created_at = (new \DateTime('now'))->format('Y-m-d H:i:s');


        $result = $dodav->save();
        if (!$result) {
            throw new Exception('PD nebola ulozena - dodavatel!',401);
        }

        $odber = new CashReceiptCustomer();
        $odber->doklad_id = $receipt->id;
        $odber->nazov = $this->receiptData['odberatel']['name'];
        $odber->kontaktna_osoba = $this->receiptData['odberatel']['contact_person'];
        $odber->ulica = $this->receiptData['odberatel']['address'];
        $odber->psc = $this->receiptData['odberatel']['zip'];
        $odber->stat = $this->receiptData['odberatel']['country'];
        $odber->ico = $this->receiptData['odberatel']['ico'];
        $odber->dic = $this->receiptData['odberatel']['dic'];
        $odber->icdph = $this->receiptData['odberatel']['icdph'];
        $odber->mesto = (json_decode($this->receiptData['odberatel']['town'],TRUE))['nazov_obce'];
        $odber->created_by = Yii::$app->user->identity->id;
        $odber->created_at = (new \DateTime('now'))->format('Y-m-d H:i:s');

        $result = $odber->save();
        if (!$result) {
            throw new Exception('PD nebola ulozena - odberatel!',401);
        }
    }

    public function zoznamSluziebPreFakturu()
    {
        $result1 = Sluzby::find()
                    ->where('status=1')
                    ->asArray()
                    ->all();
        $result2 = Baliky::find()
                    ->where('status=1')
                    ->asArray()
                    ->all();

        $result = [];

        if (is_array($result1)) {
            $result = array_merge($result,$result1);
        }

        if (is_array($result2)) {
            foreach($result2 as &$item) {
                $item['id'] = 'bal_'.$item['id'];
            }
            $result = array_merge($result,$result2);
        }

        return $result;
    }

}
