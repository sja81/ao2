<?php
namespace common\models\documents;

use backend\helpers\HelperString;
use common\models\Agent;
use common\models\ZmluvaUcel;
use Mpdf\Output\Destination;
use Yii;

class PredZmluvaDocument extends Documents implements IContractDocument
{

    private $contractNumber;
    protected $usePaging = true;
    private $zoznamMajitelov = [];

    public function setContractNumber($number)
    {
        $this->contractNumber = $number;
    }

    public function create()
    {
        $this->enablePageNumbering();

        $this->content .= $this->zmluvaHlavicka();
        $this->content .= $this->zmluvaMajitelia();
        $this->content .= $this->zmluvaNehnutelnost();
        $this->content .= $this->zmluvaMakler();
        $this->content .= $this->zmluvaUcel();

        $this->mpdf->WriteHTML($this->content);

        $this->content = $this->zmluvaCenySluzby();
        $this->mpdf->WriteHTML($this->content);

        $this->content = $this->zmluvaRovnopis();
        $this->mpdf->WriteHTML($this->content);

        $this->content = $this->zmluvaGdprPodpisMiesotDatum();
        $this->mpdf->WriteHTML($this->content);

        $this->content = $this->zmluvaPodpis();
        $this->mpdf->WriteHTML($this->content);

        $this->mpdf->Output(Yii::getAlias('@webroot')."/../docstore/".$this->contractNumber."/".$this->fileName, Destination::FILE);
        $this->writeToDatabase($this->contractNumber, $this->getTemplate());
    }

    private function zmluvaPodpis()
    {
        // aktualna pozicia
        $y = $this->mpdf->y+40;
        // zistujeme ze kolko podpisov sa zmesti na aktualnu stranku a kolko mame majitelov
        // $c - kolko podpisov sa zmesti
        $c = (int)((297-$y) / 40);
        $cZoznamMajitelov = count($this->zoznamMajitelov);

        // ak je pocet majitelov viac nez miesto pre podpis, pridame novu stranku
        if ($cZoznamMajitelov > $c) {
            $this->mpdf->AddPage();
        }

        $this->mpdf->y += (3-$cZoznamMajitelov)*40;

        $podpisy = [];

        for ($i=0; $i<$cZoznamMajitelov; $i++) {
            $obchodnik ='';
            if ($i === ($cZoznamMajitelov-1) ) {
                $obchodnik = "Za <span class='aoreal'>{$this->getOffice()->name}</span><br>konateľ";
            }
            if ($this->zoznamMajitelov[$i]['customer_type'] === 'firma') {
                $meno[] = $this->zoznamMajitelov[$i]['obchodne_meno'];
            } else {
                $meno[] = $this->zoznamMajitelov[$i]['name_first'].' '.$this->zoznamMajitelov[$i]['name_last'];
                if ($this->zoznamMajitelov[$i]['deg_before'] !== '') {
                    $meno[] = $this->zoznamMajitelov[$i]['deg_before'];
                }
                if ($this->zoznamMajitelov[$i]['deg_after'] !== '') {
                    $meno[] =  $this->zoznamMajitelov[$i]['deg_after'];
                }
            }

            $meno = implode(',',$meno);
            $podpisy[] = "<tr><td style='border-top: 1px solid black; vertical-align: top; width:40%;text-align: center;'>".
                "<div style='width: 70%;'>{$meno}</div></td><td style='width:20%'></td>".
                "<td style='vertical-align: top; width: 50%; text-align:center".($obchodnik !=='' ? '; border-top:1px solid black;' : '')."'>".
                "<div style='width: 90%; text-align: center;font-size: 0.9em'>{$obchodnik}</div></td></tr>";
        }

        return $this->render('predzmluva-podpis',[
           'podpisy' => implode('',$podpisy)
        ]);
    }

    private function zmluvaHlavicka()
    {
        return $this->render('predzmluva-hlavicka',[
            'contract_number'   => $this->contractNumber
        ]);
    }

    private function zmluvaMajitelia()
    {
        $this->fileName = $this->contractNumber."-".DocType::PREDZMLUVA."-".time().".pdf";

        $sql = "
            SELECT
                c.customer_type,
                IFNULL(c.ac_deg_before,'') AS deg_before,
                IFNULL(c.ac_deg_after,'') AS deg_after,
                IFNULL(c.name_first,'') AS name_first,
                IFNULL(c.name_last,'') AS name_last,
                IFNULL(c.maiden_name,'') AS maiden_name,
                IFNULL(date_format(c.birth_date, '%d.%m.%Y'),'') AS birth_date,
                IFNULL(c.ssn,'') AS ssn,
                IFNULL(c.address,'') AS address,
                IFNULL(c.town,'') AS town,
                IFNULL(c.zip,'') AS zip,
                IFNULL(c.email,'') AS priv_email,
                IFNULL(c.phone,'') AS phone,
                IFNULL(c.email,'') AS email,
                IFNULL(cc.ico,'') AS ico,
                IFNULL(cc.obchodne_meno,'') AS obchodne_meno,
                IFNULL(cc.telefon,'') AS telefon,
                IFNULL(cc.email,'') AS email,
                IFNULL(cc.adresa,'') AS adresa,
                IFNULL(cc.mesto,'') AS mesto,
                IFNULL(cc.psc,'') AS psc
            FROM 
                zmluva z
            JOIN
                zmluva_zakaznik zz ON z.id=zz.zmluva_id
            JOIN
                customer c on c.id=zz.zakaznik_id
            LEFT JOIN
                customer_company cc ON cc.customer_id=c.id
            WHERE
                z.cislo = :num
        ";

        $majitelia = "";
        $this->zoznamMajitelov = Yii::$app->db->createCommand($sql)->bindValue(":num",$this->contractNumber)->queryAll();

        foreach($this->zoznamMajitelov as $item) {
            $it= [];
            $adresa = [];
            if ($item['customer_type'] === 'firma') {
                $it[] = $item['obchodne_meno'];
                if ($item['adresa'] !== '') {
                    $adresa[] = $item['adresa'];
                }
                if ($item['mesto'] !== '') {
                    $adresa[] = $item['mesto'];
                }
                if ($item['psc'] !== '') {
                    $adresa[] = $item['psc'];
                }
            } else {
                $it[] = $item['name_first'].' '.$item['name_last'];
                if ($item['deg_before'] !== '') {
                    $it[] = $item['deg_before'];
                }
                if ($item['deg_after'] !== '') {
                    $it[] = $item['deg_after'];
                }
                if ($item['address'] !== '') {
                    $adresa[] = $item['address'];
                }
                if ($item['town'] !== '') {
                    $adresa[] = $item['town'];
                }
                if ($item['zip'] !== '') {
                    $adresa[] = $item['zip'];
                }
            }

            $rcIco = [];
            if($item['birth_date'] !== '') {
                $rcIco[] = $item['birth_date'];
            }
            if($item['ssn'] !== '') {
                $rcIco[] = $item['ssn'];
            }
            if($item['ico'] !== '') {
                $rcIco[] = $item['ico'];
            }

            $data = [
                'meno'      => empty($it) ? '': implode(',',$it) ,
                'adresa'    => empty($adresa) ? '': implode(',',$adresa),
                'telefon'   => str_replace(","," ", $item['phone']),
                'email'     => $item['customer_type'] === 'firma' ? $item['email'] : $item['priv_email'],
                'ico_rc'    => empty($rcIco) ? '' : implode(', ', $rcIco)
            ];

            $majitelia .= $this->render('predzmluva-majitelia', $data);
        }

        return $majitelia;
    }

    private function zmluvaNehnutelnost()
    {
        $sql = "select 
                    ifnull(p.supis_cis,'') as supis_cislo,
                    ifnull(p.orient_cisl,'') as orient_cislo,
                    ifnull(p.parc_cislo,'') as parc_cislo,
                    concat( obec_kod, '  ', mesto) as obec,
                    p.list_vlast as cislo_LV,
                    ifnull(p.cislo_byt,'') as cislo_bytu,
                    concat(p.kat_uzemie_kod,'  ', p.kat_uzemie) as kat_uzemie,
                    (select nazov from nehnut_druh where id=p.druh_nehnut) as druh_nehnutelnosti,
                    ifnull(p.ulica,'') as ulica,
                    ifnull(p.mesto,'') as mesto,
                    ifnull(p.psc,'') as psc,
                    ifnull(p.gps_lat,'') as gps_lat,
                    ifnull(p.gps_long,'') as gps_long
                from 
                    zmluva c
                join 
                    zmluva_nehnut cp on c.id=cp.zmluva_id
                join
                    nehnutelnost p on p.id=cp.nehnut_id
                where
                    c.cislo=:num";

        $items = Yii::$app->db->createCommand($sql)->bindValue(":num",$this->contractNumber)->queryOne();

        $adresa = [];
        if (isset($items['ulica']) && $items['ulica'] !== '') {
            $adresa[] = $items['ulica'];
        }
        if (isset($items['mesto']) && $items['mesto'] !== '') {
            $adresa[] = $items['mesto'];
        }
        if (isset($items['psc']) && $items['psc'] !== '') {
            $adresa[] = $items['psc'];
        }

        $data['gps'] = '';
        if (isset($items['gps_lat']) && $items['gps_lat'] !== '' && isset($items['gps_long']) && $items['gps_long'] != '') {
            $data['gps'] = '('.$items['gps_lat'].', '.$items['gps_long'].')';
        }
        foreach($items as $key=>$value) {
            $data[$key] = $value;
        }

        $data['adresa'] = implode(', ',$adresa);
        unset($adresa, $items);

        return $this->render('predzmluva-nehnutelnost', $data);
    }

    private function zmluvaMakler()
    {
        $dic = [];
        if (!is_null($this->getOffice()->dic)) {
            $dic[] = $this->getOffice()->dic;
        }
        if (!is_null($this->getOffice()->icdph) && $this->getOffice()->vat_payer == 1) {
            $dic[] = $this->getOffice()->icdph;
        }
        $result = $this->render('predzmluva-makler',[
            'obchodne_meno'     => $this->getOffice()->name,
            'email'             => $this->getOffice()->email,
            'web'               => $this->getOffice()->web,
            'ico'               => $this->getOffice()->ico,
            'tel'               => $this->getOffice()->phone,
            'sidlo'             => $this->getOffice()->address.', '.$this->getOffice()->zip.' '.$this->getOffice()->town,
            'dic_icdph'         => implode(' / ',$dic),
        ]);
        $agent = Agent::findOne(['user_id'=>Yii::$app->user->identity->getId()]);
        if ($agent && !$agent->isBusinessOwner()) {
            $result .= $this->render('predzmluva-sprostredkovatel',[]);
        }
        return $result;
    }

    private function zmluvaUcel()
    {
        $sql = "select 
                    group_concat('<li>', lower(ct.name), ' nehnuteľnosti</li>' separator '') as ucel
                from 
                    zmluva c
                join 
                    zmluva_ucel cu on c.id=cu.zmluva_id
                join
                    ucel ct on ct.id=cu.ucel_id
                where
                    c.cislo=:num";

        $ucel = Yii::$app->db->createCommand($sql)->bindValue(':num', $this->contractNumber)->queryScalar();

        return $this->render('predzmluva-ucel',[
            'ucel_zmluvy'   => $ucel
        ]);
    }

    private function zmluvaCenySluzby()
    {
        $sql = "
            select 
                c.zmluva_typ as typ_zmluvy,
                c.zmluva_platnost as platnost_zmluvy,
                ifnull(c.platnost_od,'') as platnost_od,
                ifnull(c.platnost_do,'') as platnost_do,
                TIMESTAMPDIFF(MONTH,c.platnost_od,c.platnost_do) as platnost_mesiac,
                IFNULL(c.zlava,0) as zlava,
                zc.zmluva_cena_typ,
                zc.cena,
                zc.percento,
                zc.provizia,
                zc.provizia_typ, 
                zs.pravne_sluzby,
                zs.pravne_sluzby_cena,
                zs.reklama,
                zs.reklama_cena,
                zs.cestovne,
                zs.cestovne_cena,
                zs.sluzby_ine,
                zs.sluzby_ine_popis,
                zs.spravne_popl,
                zs.spravne_popl_cena
            from 
                zmluva c
            join
                zmluva_cena zc on zc.zmluva_id=c.id
            join
                zmluva_sluzby zs on zs.zmluva_id=c.id
            where
                c.cislo=:num and zc.status=1
        ";

        $items = Yii::$app->db->createCommand($sql)->bindValue(':num',$this->contractNumber)->queryOne();

        $cena = '';
        $provizia = "";

        if ($items['zmluva_cena_typ'] == 'PREDAJ') {
            $cena .= $this->render('predzmluva-cena-predaj',[
                'suma'   => number_format($items['cena'],2,"."," "),
                'suma_slovom'    => ucfirst(HelperString::number2words($items['cena'])),
            ]);
            if ($items['provizia_typ'] == 'PERCENTO') {
                $provizia .= $this->render('predzmluva-predaj-percento',['percento' => $items['percento']]);
            } else {
                $provizia .= $this->render('predzmluva-predaj-pausal',[
                    'pausal'    => number_format($items['provizia'],2,"."," "),
                    'pausal_slovom' =>  ucfirst(HelperString::number2words($items['provizia']))
                ]);
            }
        }

        if ($items['zmluva_cena_typ'] == 'NAJOM') {
            $cena .= $this->render('predzmluva-cena-prenajom',[
                'suma'   =>  number_format($items['cena'],2,"."," "),
                'suma_slovom'    => ucfirst(HelperString::number2words($items['cena'])),
            ]);
            if ($items['prenajom_provizia_typ'] == 'PERCENTO') {
                $provizia .= $this->render('predzmluva-prenajom-percento',['percento' => $items['percento']]);
            } else {
                $provizia .= $this->render('predzmluva-prenajom-pausal',[
                    'pausal'    => number_format($items['provizia'],2,"."," "),
                    'pausal_slovom' =>  ucfirst(HelperString::number2words($items['provizia'])),
                ]);
            }
        }

        $sluzby = [];
        if (isset($items['pravne_sluzby']) && $items['pravne_sluzby'] == 1) {
            $sluzby[] = "<li>právne služby</li>";
        }
        if (isset($items['reklama']) && $items['reklama'] == 1) {
            $sluzby[] = "<li>náklady na reklamu</li>";
        }
        if (isset($items['cestovne']) && $items['cestovne'] == 1) {
            $sluzby[] = "<li>cestovné na obhliadky</li>";
        }
        if (isset($items['spravne_popl']) && $items['spravne_popl'] == 1) {
            $sluzby[] = "<li>správne poplatky (napr. na Správe katastra)</li>";
        }
        if (isset($items['sluzby_ine']) && $items['sluzby_ine'] == 1) {
            $sluzby[] = "<li>iné: {$items['sluzby_ine_popis']}</li>";
        }

        $dobaZmluvy = 'NEURČITÚ';
        $dobaZmluvyUrcita = '';
        if ($items['platnost_zmluvy'] == 2) {
            $dobaZmluvy = 'URČITÚ';
            $dobaZmluvyUrcita = $this->render('predzmluva-doba-urcita',[
                'mesiace'   => $items['platnost_mesiac'],
                'mesiace_slovom' => HelperString::number2words($items['platnost_mesiac'])
            ]);
        }


        return $this->render('predzmluva-ceny-sluzby',[
            'sluzby'    => implode("",$sluzby),
            'zlava'         =>  "...".$items['zlava']."...",
            'cas_poskytnutia_sluzieb'   => $items['typ_zmluvy'] == 'standard' ? 'NEVÝHRADNOM' : 'VÝHRADNOM',
            'doba_zmluvy'   => $dobaZmluvy,
            'cena'      => $cena,
            'provizia'  => $provizia,
            'doba_zmluvy_urcita'    => $dobaZmluvyUrcita
        ]);
    }

    private function zmluvaGdprPodpisMiesotDatum()
    {
        $result = $this->render('predzmluva-gdpr',[]);
        $result .= $this->render('predzmluva-podpis-miesto-datum',[
            'podpis_datum'     => $this->getDate(),
            'podpis_miesto'    => $this->getPodpisMiesto(),
        ]);
        return $result;
    }

    private function zmluvaRovnopis()
    {
        $zaujem = [];

        $sql = "select 
                    cu.ucel_id
                from 
                    zmluva c
                join 
                    zmluva_ucel cu on c.id=cu.zmluva_id
                where
                    c.cislo=:num";

        $ucel = Yii::$app->db->createCommand($sql)->bindValue(':num', $this->contractNumber)->queryAll();

        foreach ($ucel as $it) {
            $txt = '';
            if ($it['ucel_id'] == ZmluvaUcel::PREDAJ) {
                $txt = 'kúpu';
            }
            if ($it['ucel_id'] == ZmluvaUcel::NAJOM) {
                $txt = 'nájom';
            }
            if ($txt !== '') {
                $zaujem[] = "<li>{$txt}</li>";
            }
        }

        return $this->render('predzmluva-rovnopis',[
            'rovnopisy'     => count($this->zoznamMajitelov) + 1,
            'zaujem'    => implode('',$zaujem),
        ]);
    }


    protected function getTemplateData()
    {
        // netreba sem nic dat!!!
    }


}