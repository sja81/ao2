<?php
namespace common\models\documents;

use Yii;

final class NaborBytDocument extends Documents implements IContractDocument
{
    private $contractNumber = null;

    public function setContractNumber($number)
    {
        $this->contractNumber = $number;
    }

    public function create()
    {
        parent::create();
        $this->writeToFile($this->contractNumber);
        $this->writeToDatabase($this->contractNumber, DocType::NABOR_BYT);
    }

    protected function getTemplateData()
    {

        $sql = "select 
                    c.id,
                    pb.nehnut_id,
                    pb.spravca_nazov,
                    pb.spravca_ico,
                    pb.spravca_sidlo,
                    pb.poschodie,
                    pb.pocet_poschodi,
                    pb.rok_kolaudacie,
                    (select nazov from konfiguracia where id=pb.orientacia) as orientacia,
                    pb.vytah,
                    ifnull(pb.podmienka_prenajom,'') as podmienka_prenajom,
                    ifnull(pb.podmienka_prevod,'') as podmienka_prevod,
                    pb.pocet_miestnosti,
                    (select concat(ulica,', ',mesto) from nehnutelnost where id=cp.nehnut_id) as nazov_ulice,
                    pb.dalsi_popis,
                    (select GROUP_CONCAT(nazov SEPARATOR '<br>') from konfiguracia where find_in_set (id, pb.stena)) as stena,
                    (select GROUP_CONCAT(nazov SEPARATOR '<br>') from konfiguracia where find_in_set (id, pb.kurenie)) as kurenie,
                    (select GROUP_CONCAT(nazov SEPARATOR '<br>') from konfiguracia where find_in_set (id, pb.okno)) as okno,
                    (select GROUP_CONCAT(nazov SEPARATOR '<br>') from konfiguracia where find_in_set (id, pb.vlastnictvo)) as vlastnictvo,
                    (select nazov from konfiguracia where id = pb.stav) as stav_bytu,
                    (select nazov from konfiguracia where id = pb.vchodove_dvere) as vchodove_dvere,
                    (select GROUP_CONCAT(nazov SEPARATOR '<br>') from konfiguracia where find_in_set (id, pb.financovanie)) as financovanie,
                    pb.plocha_uzitkova,
                    ifnull(pb.pocet_garaz,0) as pocet_garaz,
                    ifnull(pb.garazove_statie,0) as garazove_statie,
                    ifnull(pb.parkovanie,0) as parkovanie,
                    ifnull(pb.teras,0) as terasa,
                    ifnull(pb.balkon,0) as balkon,
                    ifnull(pb.pivnica,0) as pivnica,
                    concat(
                        if(pb.bazen is not null and pb.bazen!=0,'<li>baz??n</li>',''),
                        if(pb.jacuzzi is not null and pb.jacuzzi!=0,'<li>jacuzzi</li>',''),
                        if(pb.satelit is not null and pb.satelit!=0,'<li>satelit</li>',''),
                        if(pb.krb is not null and pb.krb!=0,'<li>krb</li>',''),
                        if(pb.klima is not null and pb.klima!=0,'<li>kl??ma</li>',''),
                        if(pb.chodba is not null and pb.chodba!=0,'<li>chodba</li>',''),
                        if(pb.sauna is not null and pb.sauna!=0,'<li>sauna</li>',''),
                        if(pb.pevna_linka is not null and pb.pevna_linka!=0,'<li>pevn?? linka</li>',''),
                        if(pb.solarium is not null and pb.solarium!=0,'<li>sol??rium</li>',''),
                        if(pb.letna_kuchyna is not null and pb.letna_kuchyna!=0,'<li>letn?? kuchy??a</li>',''),
                        if(pb.altanok is not null and pb.altanok!=0,'<li>alt??nok</li>',''),
                        if(pb.video_vratnik is not null and pb.video_vratnik!=0,'<li>video vr??tnik</li>',''),
                        if(pb.zimna_zahrada is not null and pb.zimna_zahrada!=0,'<li>zimn?? z??hrada</li>',''),
                        if(pb.pivnica is not null and pb.pivnica!=0,'<li>pivnica</li>',''),
                        if(pb.komora is not null and pb.komora!=0,'<li>komora</li>',''),
                        if(pb.plyn is not null and pb.plyn!=0,'<li>plyn</li>',''),
                        if(pb.hromozvod is not null and pb.hromozvod!=0,'<li>hromozvod</li>',''),
                        if(pb.stodola is not null and pb.stodola!=0,'<li>stodola</li>',''),
                        if(pb.elektrina_230_400 is not null and pb.elektrina_230_400!=0,'<li>elektrina 230/400</li>',''),
                        if(pb.studna is not null and pb.studna!=0,'<li>stud??a</li>',''),
                        if(pb.dielna is not null and pb.dielna!=0,'<li>diel??a</li>',''),
                        if(pb.ventilator is not null and pb.ventilator!=0,'<li>ventil??tor</li>',''),
                        if(pb.vinna_pivnica is not null and pb.vinna_pivnica!=0,'<li>v??nna pivnica</li>',''),
                        if(pb.rekuperacia is not null and pb.rekuperacia!=0,'<li>rekuper??cia</li>',''),
                        if(pb.predsien is not null and pb.predsien!=0,'<li>predsie??</li>',''),
                        if(pb.akvarium is not null and pb.akvarium!=0,'<li>akv??rium</li>',''),
                        if(pb.kotolna is not null and pb.kotolna!=0,'<li>kotol??a</li>',''),
                        if(pb.pracovna is not null and pb.pracovna!=0,'<li>pr????ov??a</li>',''),
                        if(pb.domace_kino is not null and pb.domace_kino!=0,'<li>dom??ce kino</li>',''),
                        if(pb.zavl_system is not null and pb.zavl_system!=0,'<li>zavla??ovac?? syst??m</li>',''),
                        if(pb.vytah is not null and pb.vytah!=0,'<li>v????ah</li>',''),
                        if(pb.biliard is not null and pb.biliard!=0,'<li>biliard</li>',''),
                        if(pb.fitnes_miest is not null and pb.fitnes_miest!=0,'<li>fitnes miestnos??</li>',''),
                        if(pb.mest_voda is not null and pb.mest_voda!=0,'<li>mestsk?? voda</li>',''),
                        if(pb.internet is not null and pb.internet!=0,
                            concat('<li>Internet: ',(select nazov from konfiguracia where id=pb.internet),'</li>'),
                            ''
                        ),
                        if(pb.bar_pult is not null and pb.bar_pult!=0,'<li>bar pult</li>',''),
                        if(pb.herne_automaty is not null and pb.herne_automaty!=0,'<li>hern?? automaty</li>',''),
                        if(pb.bezp_system is not null and pb.bezp_system != '',
                            concat('<li>', ( select group_concat(nazov separator ',') from konfiguracia where find_in_set (id,pb.bezp_system) ), '</li>'),
                            ''
                        )
                    ) as property_basic                        
                from
                    zmluva c
                join
                    zmluva_nehnut cp on cp.zmluva_id = c.id
                join
                    nehnut_zaklady pb on pb.nehnut_id=cp.nehnut_id
                where
                    c.`cislo`='".$this->contractNumber."'
        ";

        $items = Yii::$app->db->createCommand($sql)->queryOne();
        $contractId = $items['id'];

        $sql = "select 
                     concat(a.name_first, ' ', a.name_last) as agent_name
                from 
                    zmluva_agent ca
                join
                    agent a on a.id=ca.agent_id
                where 
                    ca.zmluva_id=:id";

        $agent = Yii::$app->db->createCommand($sql)->bindValue(':id', $contractId)->queryScalar();

        $parkovanie = '';
        if ($items['pocet_garaz']>0) {
            $parkovanie .= "gar????<br>";
        }
        if ($items['garazove_statie']>0) {
            $parkovanie .= "gar????ov?? st??tie<br>";
        }
        if ($items['parkovanie']>0) {
            $parkovanie .= "parkovisko";
        }

        $exterier = "";
        if ($items['terasa']>0) {
            $exterier .= "terasa&nbsp;&nbsp;{$items['terasa']}&nbsp;m<sup>2</sup><br>";
        }
        if ($items['balkon']>0) {
            $exterier .= "balk??n&nbsp;&nbsp;{$items['balkon']}&nbsp;m<sup>2</sup><br>";
        }
        if ($items['pivnica']>0) {
            $exterier .= "pivnica&nbsp;&nbsp;{$items['pivnica']}&nbsp;m<sup>2</sup>";
        }

        $this->templateData = [
            'cislo_zmluvy'  => $this->contractNumber,
            'spravca'       => $items['spravca_nazov'],
            'spravca_ico'   => $items['spravca_ico'],
            'spravca_sidlo' => $items['spravca_sidlo'],
            'poschodie'     => $items['poschodie'],
            'pocet_poschodi' => $items['pocet_poschodi'],
            'kolaudacia'    => $items['rok_kolaudacie'],
            'orientacia'    => $items['orientacia'],
            'vytah'     => $items['vytah'] == 1 ? "??NO": "NIE",
            'prevod_nehnutelnosti'  => $items['podmienka_prevod'],
            'prenajom_nehnutelnosti' => $items['podmienka_prenajom'],
            'datum'     => $this->getDate(),
            'meno_maklera'  => $agent,
            'pocet_izieb'   => $items['pocet_miestnosti'],
            'nazov_ulice'   => $items['nazov_ulice'],
            'dalsi_popis'   => $items['dalsi_popis'],
            'material'      => $items['stena'],
            'kurenie'       => $items['kurenie'],
            'okno'          => $items['okno'],
            'vlastnictvo'   => $items['vlastnictvo'],
            'stav_bytu'     => $items['stav_bytu'],
            'financovanie'  => $items['financovanie'],
            'vchodove_dvere'    => $items['vchodove_dvere'],
            'plocha'    => $items['plocha_uzitkova'],
            'parkovanie'    =>  $parkovanie,
            'exterier'  => $exterier,
            'property_basic'    => $items['property_basic']
        ];

    }

}