<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

class ZmluvaUcel extends ActiveRecord
{
    const PREDAJ = 1;
    const NAJOM = 2;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'zmluva_ucel';
    }

    /**
     * @param int $zmluvaId
     * @param array $data
     */
    public function pripojUcel(int $zmluvaId, array $data)
    {
        foreach ($data as $item) {
            $this->zmluva_id = $zmluvaId;
            $this->ucel_id = $item;
            $result = $this->save();

            if (!$result) {
                throw new Exception('Nemozem pripojit ucely ku zmluve!', 401);
            }
        }
    }

    public static function vratUcel(int $zmluvaId)
    {
        $sql = "SELECT 
                    group_concat(u.`name` SEPARATOR ',') AS ucely
                FROM
                    zmluva_ucel zu
                JOIN
                    ucel u ON u.id=zu.ucel_id
                WHERE
                    zmluva_id = {$zmluvaId} AND u.`status`=1 AND zu.`status`=1;";

        return Yii::$app->db->createCommand($sql)->queryScalar();
    }

}