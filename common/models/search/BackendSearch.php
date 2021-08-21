<?php
namespace common\models\search;

use Yii;

final class BackendSearch
{
    const PAGE_LIMIT = 12;

    private $typ;    // t
    private $druh;   // dru
    private $stav;   // st
    private $stat;   // stt
    private $kraj;   // kr
    private $okres;  // okres
    private $mesto;  // m
    private $cena_od; // cod
    private $cena_do; // cdo
    private $vymera_od; // vod
    private $vymera_do; // vdo
    private $pocet_miestnosti; // pocmiest
    private $fulltext_id; // ftx

    public function nastavParametre(array $data)
    {
        $this->typ = isset($data['t']) ? $data['t'] : null;
        $this->druh = isset($data['dru']) ? $data['dru'] : null;
        $this->stav = isset($data['st']) ? $data['st'] : null;
        $this->stat = isset($data['stt']) ? $data['stt'] : null;
        $this->kraj = isset($data['kr']) ? $data['kr'] : null;
        $this->okres = isset($data['okr']) ? $data['okr'] : null;
        $this->mesto = isset($data['m']) ? $data['m'] : null;
        $this->cena_od = isset($data['cod']) ? $data['cod'] : null;
        $this->cena_do = isset($data['cdo']) ? $data['cdo'] : null;
        $this->vymera_od= isset($data['vod']) ? $data['vod'] : null;
        $this->vymera_do= isset($data['vdo']) ? $data['vdo'] : null;
        $this->pocet_miestnosti = isset($data['pocmiest']) ? $data['pocmiest'] : null;
        $this->fulltext_id = isset($data['ftx']) ? $data['ftx'] : null;
    }

    public function zoznamZmluv(int $agentId = null, int $limit = null, int $page = null)
    {
        $limitStr = $whereStr = "";

        $whereStr = $this->generateWhere();

        $whereStr = $whereStr != "" ? " WHERE {$whereStr} " : "";

        $sql = "
            SELECT 
                z.id,
                z.`status`,
                z.cislo,
                n.ulica,
                n.mesto,
                CONCAT(a.name_first, ' ', a.name_last) AS agent_name
            FROM
                nehnutelnost n 
            LEFT JOIN
                nehnut_zaklady nz ON nz.nehnut_id=n.id
            LEFT JOIN 
            	zmluva_nehnut zn ON zn.nehnut_id = n.id
            LEFT JOIN
                zmluva z ON z.id = zn.zmluva_id
            LEFT JOIN
                zmluva_ucel zu ON zu.zmluva_id=z.id AND zu.`status`=1
            LEFT JOIN
                zmluva_cena zc ON zc.zmluva_id=z.id AND zc.`status`=1
            LEFT JOIN
                zmluva_agent za ON z.id = za.zmluva_id
            LEFT JOIN
                agent a ON a.id = za.agent_id
            {$whereStr}        
                order by z.cislo        
            {$limitStr}
        ";

        $result = Yii::$app->db->createCommand($sql)->queryAll();

        foreach($result as &$item) {
            $item['ucel'] = Yii::$app->db->createCommand("
                        SELECT 
                            ct.`name`
                        FROM
                            zmluva_ucel cu
                                JOIN
                            ucel ct ON ct.id = cu.ucel_id
                        WHERE
                            cu.zmluva_id = :id AND cu.`status` = 1;"
            )->bindValue(':id',$item['id'])->queryAll();
        }

        return $result;
    }

    public function pocetZmluv(int $agentId=null)
    {
        $whereStr = $this->generateWhere();

        $whereStr = $whereStr != "" ? " WHERE {$whereStr} " : "";

        $sql = "
            SELECT 
                count(z.id)
            FROM
                nehnutelnost n 
            LEFT JOIN
                nehnut_zaklady nz ON nz.nehnut_id=n.id
            LEFT JOIN 
            	zmluva_nehnut zn ON zn.nehnut_id = n.id
            LEFT JOIN
                zmluva z ON z.id = zn.zmluva_id
            LEFT JOIN
                zmluva_ucel zu ON zu.zmluva_id=z.id AND zu.`status`=1
            LEFT JOIN
                zmluva_cena zc ON zc.zmluva_id=z.id AND zc.`status`=1
            LEFT JOIN
                zmluva_agent za ON z.id = za.zmluva_id
            LEFT JOIN
                agent a ON a.id = za.agent_id
            {$whereStr}";

        return Yii::$app->db->createCommand($sql)->queryScalar();
    }

    private function generateWhere()
    {
        $where = [];

        if (!is_null($this->mesto)) {
            $where[] = sprintf("n.mesto IN (%s)", implode(",",$this->mesto));
        }
        if (!is_null($this->stat)) {
            $where[] = sprintf("n.stat IN (%s)", implode(",",$this->stat));
        }

        if (!is_null($this->pocet_miestnosti)) {
            $where[] = sprintf("nz.pocet_miestnosti IN (%s)", implode(",", $this->pocet_miestnosti));
        }

        if (!is_null($this->druh)) {
            $druhy = [];
            foreach ($this->druh as $item) {
                if (strpos($item,"k-") !== false) {
                    $id = (int)(trim($item,"k- "));
                    $res = Yii::$app->db->createCommand("select id from nehnut_druh where kategoria_id={$id}")->queryAll();
                    foreach($res as $it) {
                        $druhy[] = $it['id'];
                    }
                    unset($id, $res);
                } else {
                    $druhy[] = $item['id'];
                }
            }
            $where[] = sprintf("n.druh_nehnut IN (%s)", implode(",", $druhy));
        }

        if (!is_null($this->stav)) {
            $where[] = sprintf("nz.stav IN (%s)", implode(",", $this->stav));
        }

        if (!is_null($this->cena_od) && $this->cena_od > 0) {
            $where[] = sprintf("zc.cena <= %.2f", (float)$this->cena_od );
        }

        if (!is_null($this->cena_do) && $this->cena_do > 0) {
            $where[] = sprintf("zc.cena >= %.2f", (float)$this->cena_do );
        }

        if (!is_null($this->vymera_od) && $this->vymera_od > 0) {
            $where[] = sprintf("nz.plocha_celkova <= %.2f", (float)$this->vymera_od );
        }

        if (!is_null($this->vymera_do) && $this->vymera_do > 0) {
            $where[] = sprintf("nz.plocha_celkova >= %.2f", (float)$this->vymera_do);
        }

        if (!is_null($this->kraj)) {
            $where[] = sprintf("n.kraj IN (%s)", implode(",",$this->kraj));
        }

        if (!is_null($this->okres)) {
            $where[] = sprintf("n.okres IN (%s)", implode(",",$this->okres));
        }

        if (!is_null($this->typ)) {
            $where[] = sprintf("zu.ucel_id IN (%s)", implode(",",$this->typ));
        }

        return implode(" AND ", $where);
    }

}