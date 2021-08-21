<?php


namespace common\models\documents;


use backend\helpers\HelpersNum;
use common\helpers\DateHelper;
use common\models\Invoice;
use common\models\InvoiceItem;
use Mpdf\Output\Destination;
use function GuzzleHttp\Psr7\str;

class FakturaDocument extends Documents
{
    protected $usePaging = true;
    private $invoice = null;
    private $customer = null;
    private $polozky = [];
    private $sumTotal = 0;
    private $sumTotalDPH = 0;
    private $platcaDPH = false;

    private $typFaktury = [
        0   => 'Faktúra',
        1   => 'Zálohová faktúra',
        2   => 'Dobropis'
    ];

    public function __construct(int $id)
    {
        $this->invoice = Invoice::findOne($id);
        $this->customer = $this->invoice->customer;
        $this->polozky = InvoiceItem::find()->andWhere(['=','status',1])->andWhere(['=','faktura_id',$id])->all();
        $this->platcaDPH = $this->invoice->dodavatel->platca_dph == 1 ? true : false;
        parent::__construct();
    }

    protected function getTemplateData()
    {
        $this->templateData = [
            'faktura.nadpis'    => $this->typFaktury[$this->invoice->typ_faktury],
            'faktura.cislo'     => $this->invoice->getInvoiceNumber(),
            'dod.nazov'         => $this->invoice->dodavatel->nazov,
            'dod.ulica'         => $this->invoice->dodavatel->ulica,
            'dod.psc'           => $this->invoice->dodavatel->psc,
            'dod.mesto'         => $this->invoice->dodavatel->mesto,
            'dod.stat'          => $this->invoice->dodavatel->stat,
            'dod.ico'          => $this->invoice->dodavatel->ico,
            'dod.dic'          => $this->invoice->dodavatel->dic,
            'dod.icdph'          => $this->invoice->dodavatel->icdph,
            'dod.telefon'          => $this->invoice->dodavatel->telefon,
            'dod.email'          => $this->invoice->dodavatel->email,
            'dod.web'          => $this->invoice->dodavatel->web,
            'dod.iban'          => $this->invoice->dodavatel->iban,
            'dod.swift'          => $this->invoice->dodavatel->swift,
            'dod.banka'          => $this->invoice->dodavatel->banka,
            'dod.info'          => $this->invoice->dodavatel->info,
            'odb.nazov'         => $this->invoice->customer->nazov ?: $this->invoice->customer->kontaktna_osoba,
            'odb.ulica'         => $this->invoice->customer->ulica,
            'odb.mesto'         => $this->invoice->customer->mesto,
            'odb.psc'         => $this->invoice->customer->psc,
            'odb.stat'          => $this->invoice->customer->stat,
            'odb.info'        => $this->invoice->customer->poznamka,
            'uhrada'          => $this->invoice->forma_uhrady,
            'symbol.var'      => $this->invoice->var_symbol,
            'symbol.konst'    => $this->invoice->konst_symbol,
            'dodacia'         => $this->renderFakturacnaAdresa(),
            'datum.vystavenia'  => DateHelper::formatDate($this->invoice->datum_vystavenia,DateHelper::INV_FORMAT),
            'datum.dodania'     => DateHelper::formatDate($this->invoice->datum_dodania,DateHelper::INV_FORMAT),
            'datum.splatnosti'  => DateHelper::formatDate($this->invoice->splatnost,DateHelper::INV_FORMAT),
            'odbico'          => $this->renderOdberatelIco(),
            'dodav.platca'    => $this->invoice->dodavatel->platca_dph == 0 ? 'Neplatca DPH' : 'Platca DPH',
        ];
    }

    private function renderFakturacnaAdresa()
    {
        if (is_null($this->customer->dodacia_ulica) || $this->customer->dodacia_ulica == '') {
            return '';
        }
        $result = file_get_contents($this->getTemplatePath()."inv-dodacia.tpl");
        $result = str_replace('{{dodacia.nazov}}',$this->customer->dodacia_nazov, $result);
        $result = str_replace('{{dodacia.ulica}}',$this->customer->dodacia_ulica, $result);
        $result = str_replace('{{dodacia.mesto}}',$this->customer->dodacia_mesto, $result);
        $result = str_replace('{{dodacia.psc}}',$this->customer->dodacia_psc, $result);
        $result = str_replace('{{dodacia.stat}}',$this->customer->dodacia_stat, $result);

        return $result;
    }

    private function renderOdberatelIco()
    {
        if (is_null($this->customer->ico)) {
            return '';
        }
        $result = file_get_contents($this->getTemplatePath()."inv-odb-ico.tpl");
        $result = str_replace('{{odb.ico}}',$this->customer->ico, $result);
        $result = str_replace('{{odb.dic}}', $this->customer->dic, $result);
        $result = str_replace('{{odb.icdph}}', $this->customer->icdph, $result);

        return $result;
    }

    private function renderPolozkyHead()
    {
        $template = "inv-polozky-head.tpl";
        if ($this->platcaDPH) {
            $template = "inv-polozky-head-dph.tpl";
        }
        $result = file_get_contents($this->getTemplatePath().$template);
        $this->mpdf->WriteHTML($result);
    }

    private function renderPolozky()
    {
        $template = "inv-polozky.tpl";
        if ($this->platcaDPH) {
            $template = "inv-polozky-dph.tpl";
        }
        $content = file_get_contents($this->getTemplatePath().$template);

        foreach ($this->polozky as $it) {
            $result = $content;
            $posY = $this->mpdf->y;
            if ($posY >= 270) {
                $this->mpdf->AddPage();
                $this->renderPolozkyHead();
            }
            $result = str_replace('{{popis_polozky}}', $it->polozka_text, $result);
            $result = str_replace('{{mnozstvo}}', floatval($it->mnozstvo), $result);
            $result = str_replace('{{merna_jednotka}}', $it->merna_jednotka, $result);
            $result = str_replace('{{cena}}', HelpersNum::moneyFormat($it->cena), $result);
            $result = str_replace('{{total_cena}}', HelpersNum::moneyFormat($it->total_cena), $result);
            if ($this->platcaDPH) {
                $result = str_replace('{{dph}}', $it->dph."%", $result);
                $result = str_replace('{{total_cena_s_dph}}', HelpersNum::moneyFormat($it->total_cena_s_dph), $result);
                $this->sumTotalDPH += $it->total_cena_s_dph;
            }
            $this->sumTotal += $it->total_cena;
            $this->mpdf->WriteHTML($result);
        }

        // renderovanie zlavy
        if (!is_null($this->invoice->zlava)) {
            $result = $content;
            $posY = $this->mpdf->y;
            if ($posY >= 270) {
                $this->mpdf->AddPage();
                $this->renderPolozkyHead();
            }
            $zlavaCena = (-1) * ($this->sumTotal*$this->invoice->zlava/100);
            $zlavaCenaDPH = (-1) * ($this->sumTotalDPH*$this->invoice->zlava/100);
            $result = str_replace('{{popis_polozky}}', 'Zľava '.floatval($this->invoice->zlava).'%', $result);
            $result = str_replace('{{mnozstvo}}', 1, $result);
            $result = str_replace('{{merna_jednotka}}', 'ks', $result);
            $result = str_replace('{{cena}}', HelpersNum::moneyFormat($zlavaCena), $result);
            $result = str_replace('{{total_cena}}', HelpersNum::moneyFormat($zlavaCena), $result);
            if ($this->platcaDPH) {
                $result = str_replace('{{dph}}', '', $result);
                $result = str_replace('{{total_cena_s_dph}}', HelpersNum::moneyFormat($zlavaCenaDPH), $result);
            }
            $this->sumTotal += $zlavaCena;
            $this->sumTotalDPH += $zlavaCenaDPH;
            $this->mpdf->WriteHTML($result);
        }
    }

    private function renderTotal()
    {
        $template = $this->platcaDPH ? "inv-polozky-total-dph.tpl" : "inv-polozky-total.tpl";
        $result = file_get_contents($this->getTemplatePath().$template);

        if ($this->platcaDPH) {
            $result = str_replace('{{faktura.total}}', HelpersNum::moneyFormat($this->sumTotal), $result);
            $result = str_replace('{{faktura.totalDPH}}', HelpersNum::moneyFormat($this->sumTotalDPH - $this->sumTotal), $result);
            $result = str_replace('{{faktura.sumTotalDPH}}', HelpersNum::moneyFormat($this->sumTotalDPH), $result);
        } else {
            $result = str_replace('{{faktura.total}}', HelpersNum::moneyFormat($this->sumTotal), $result);
        }

        $this->mpdf->WriteHTML($result);
    }

    private function renderBottom()
    {
        $result = file_get_contents($this->getTemplatePath()."inv-bottom.tpl");
        if ($this->invoice->peciatka == 1) {
            $result = str_replace('{{faktura.pecset}}','companies/'.$this->invoice->dodavatel->dodavatel_id.'/pecset.png', $result);
        } else {
            $result = str_replace('{{faktura.pecset}}','', $result);
        }

        $this->mpdf->WriteHTML($result);
    }

    private function renderPoznamka()
    {
        $template = $this->platcaDPH ? "inv-poznamka-dph.tpl" : "inv-poznamka.tpl";
        $result = file_get_contents($this->getTemplatePath().$template);
        $result = str_replace('{{faktura.poznamka}}', $this->invoice->poznamka, $result);
        $result = str_replace('{{faktura.vystavil}}', $this->invoice->vystavil, $result);

        if ($this->platcaDPH) {
            $result = str_replace('{{rekap.total_cena_s_dph}}', HelpersNum::moneyFormat($this->sumTotalDPH).' '.strtoupper($this->invoice->mena), $result);
            $result = str_replace('{{rekap.dph}}', HelpersNum::moneyFormat($this->sumTotalDPH - $this->sumTotal).' '.strtoupper($this->invoice->mena), $result);
            $result = str_replace('{{rekap.total_cena}}', HelpersNum::moneyFormat($this->sumTotal).' '.strtoupper($this->invoice->mena), $result);
            // platil zalohu?
            if (!is_null($this->invoice->zaloha)) {
                $zaloha = '<tr><td width="50%">Uhradená zálohami:</td><td class="ta-right"> -'. HelpersNum::moneyFormat($this->invoice->zaloha);
                $zaloha .= ' '.strtoupper($this->invoice->mena).'</td></tr>';
                $result = str_replace('{{rekap.zalohy}}',$zaloha, $result);
                $this->sumTotalDPH -= $this->invoice->zaloha;
            }
            $result = str_replace('{{rekap.kuhrade}}',HelpersNum::moneyFormat($this->sumTotalDPH).' '.strtoupper($this->invoice->mena), $result);
        } else {
            if (!is_null($this->invoice->zaloha)) {
                $zaloha = '<tr><td width="50%">Uhradená zálohami:</td><td class="ta-right"> -'. HelpersNum::moneyFormat($this->invoice->zaloha);
                $zaloha .= ' '.strtoupper($this->invoice->mena).'</td></tr>';
                $result = str_replace('{{rekap.zalohy}}',$zaloha, $result);
                $this->sumTotal -= $this->invoice->zaloha;
            }
            if (!is_null($this->invoice->zlava) || !is_null($this->invoice->zaloha)) {
                $celkova = '<tr><td width="50%">Celková suma:</td><td class="ta-right">';
                $celkova .= HelpersNum::moneyFormat($this->sumTotal).' '. strtoupper($this->invoice->mena).'</td></tr>';
                $result = str_replace('{{rekap.celkova}}',$celkova, $result);
            }
            $result = str_replace('{{rekap.kuhrade}}',HelpersNum::moneyFormat($this->sumTotal).' '.strtoupper($this->invoice->mena), $result);
        }

        $this->mpdf->WriteHTML($result);
    }

    public function downloadFile($contractNumber)
    {
        $this->fileName = $contractNumber."-".$this->template."-".time().".pdf";
        try{
            $this->mpdf->WriteHTML($this->content);
            $this->renderPolozkyHead();
            $this->renderPolozky();
            $this->renderTotal();
            $this->renderPoznamka();
            $this->renderBottom();
        } catch(\Mpdf\MpdfException $ex) {
            echo $ex->getLine();
            print_r($ex->getTrace());
            exit;
        }
        $this->mpdf->Output($this->fileName, Destination::DOWNLOAD);
    }
}