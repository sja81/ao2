<?php
namespace common\models;

use common\helpers\DateHelper;
use Yii;
use yii\db\ActiveRecord;

class Zmluva extends ActiveRecord
{
    const FINISHED = 4;     // obchod sa podaril
    const REMOVED = 3;      // "zmazane"
    const ACTIVE = 2;
    const APPROVED = 1;     // potvrdene ale este nemusi byt aktivne
    const PENDING = 0;      // cerstvo vytvorene

    const EXCLUSIVE = 'exclusive';
    const STANDARD = 'standard';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'zmluva';
    }



    /**
     * @return string
     */
    public static function getCisloZmluvy()
    {
        $posledneCislo = self::find()
            ->select(['cislo'])
            ->orderBy('id DESC')
            ->one();

        $posledneCislo = !is_null($posledneCislo) ? $posledneCislo->cislo : false;
        $actualYear = DateHelper::getActualYear();

        if (!$posledneCislo) {
            return "{$actualYear}0001";
        }

        $year = substr($posledneCislo, 0, 4);
        $orderNumber = substr($posledneCislo, 6);

        $newCode = ($year <> $actualYear) ? strval($actualYear) : strval($year);
        $newCode .= ($year <> $actualYear) ?
            str_pad(strval(1),6,'0', STR_PAD_LEFT) :
            str_pad(strval($orderNumber+1), 4, '0', STR_PAD_LEFT);

        return $newCode;
    }

    /**
     * @param string $cislo
     * @param integer $agentId\
     * @return int
     */
    public function pridajZmluvu(string $cislo, int $agentId)
    {
        $this->cislo = $cislo;
        $this->created_by = $agentId;
        $this->status = ZmluvaStatus::PENDING;
        $res = $this->save();
        if(!$res) {
            throw new Exception('Zmluva nebola ulozena!', 404);
        }
    }

    /**
     * @param int $id
     */
    public function vytvorAdresare()
    {
        $path = Yii::getAlias('@webroot')."/../../frontend/web/content/{$this->cislo}";

        if(!file_exists($path)) {
            mkdir($path);
        }
        $path = Yii::getAlias('@webroot')."/../../frontend/web/content/{$this->cislo}/images";
        if(!file_exists($path)) {
            mkdir($path);
        }
        $path = Yii::getAlias('@webroot')."/../../frontend/web/content/{$this->cislo}/video";
        if(!file_exists($path)) {
            mkdir($path);
        }
        $path = Yii::getAlias('@webroot')."/../docstore/{$this->cislo}";
        if(!file_exists($path)) {
            mkdir($path);
        }
    }

    /**
     * @param int|null $agentId
     * @param int|null $limit
     * @param int|null $page
     * @return array
     * @throws yii\db\Exception
     */
    public function zoznamZmluv(int $agentId = null, int $limit = null, int $page = null)
    {
        $limitStr = $whereStr = "";

        if (!is_null($limit)) {
            $limitStr = " LIMIT {$limit}";
        }
        if (!is_null($limit) && !is_null($page)) {
            $limitStr = " LIMIT {$page},{$limit}";
        }
        if (!is_null($agentId)) {
            $whereStr = " WHERE c.created_by= {$agentId}";
        }

        $sql = "
            SELECT 
                c.id,
                c.`status`,
                c.`cislo`,
                CONCAT(a.name_first, ' ', a.name_last) AS agent_name,
                p.ulica,
                p.mesto,
                ifnull(nz.pocet_miestnosti,0) as pocet_miestnosti,
                ifnull(nz.pocet_kuchyna,0) as pocet_kuchyna,
                ifnull(nz.pocet_garaz,0) as pocet_garaz,
                ifnull(nz.garazove_statie,0) as garazove_statie,
                ifnull(nz.parkovanie,0) as parkovanie,
                ifnull(nz.pocet_kupelna,0) as pocet_kupelna,
                (select concat(name_first,' ',name_last) from customer where id=zz.zakaznik_id) as meno_zakaznika
            FROM
                zmluva c
                LEFT JOIN
                zmluva_agent ca ON c.id = ca.zmluva_id
                LEFT JOIN
                agent a ON a.id = ca.agent_id
                LEFT JOIN
                zmluva_nehnut cp ON cp.zmluva_id = c.id
                LEFT JOIN
                nehnutelnost p ON cp.nehnut_id = p.id
                LEFT JOIN
                nehnut_zaklady nz ON nz.nehnut_id=p.id
                LEFT JOIN
                zmluva_zakaznik zz ON zz.zmluva_id = c.id
            {$whereStr}        
                order by c.cislo        
            {$limitStr}    
        ";

        $result = Yii::$app->db->createCommand($sql)->queryAll();

        foreach($result as &$item) {

            $item['cena'] = Yii::$app->db->createCommand(
                "select zmluva_cena_typ, cena from zmluva_cena where zmluva_id={$item['id']} and status=1"
            )->queryALl();

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


    /**
     * @param int|null $agentId
     */
    public function pocetZmluv(int $agentId=null)
    {
        $whereStr = "";
        if (!is_null($agentId)) {
            $whereStr = " WHERE c.created_by= {$agentId}";
        }
        $sql = "
            SELECT 
                count(c.id) as Pocet
            FROM
                zmluva c
                LEFT JOIN
                zmluva_agent ca ON c.id = ca.zmluva_id
                LEFT JOIN
                agent a ON a.id = ca.agent_id
                LEFT JOIN
                zmluva_nehnut cp ON cp.zmluva_id = c.id
                LEFT JOIN
                nehnutelnost p ON cp.nehnut_id = p.id
            {$whereStr}            
        ";

        return Yii::$app->db->createCommand($sql)->queryScalar();
    }

    /**
     * @return string
     */
    public function getUploadDir()
    {
        return Yii::getAlias('@webroot')."/../../frontend/web/content";
    }

    /**
     * @param array $data
     */
    public function pridajUdajeDoZmluvy(array $data)
    {
        $toUpdate = [
            'platnost_od',
            'platnost_do',
            'zmluva_typ',
            'zmluva_platnost',
            'zobr_na_web',
            'prioritne',
            'top_ponuka',
            'zlava'
        ];
        foreach($toUpdate as $item) {
            if (in_array($item, $data)) {
                $this->$item = $data[$item];
            }
        }

        $result = $this->save();

        if (!$result) {
            throw new Exception('Nemozem ulozit informaciu o zmluve', 401);
        }

    }

    public function pocetZakaznikov()
    {
        $sql = "SELECT COUNT(id) FROM zmluva_zakaznik WHERE zmluva_id={$this->id}";
        return Yii::$app->db->createCommand($sql)->queryScalar();
    }

}