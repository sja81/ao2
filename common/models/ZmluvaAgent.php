<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

class ZmluvaAgent extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'zmluva_agent';
    }

    public static function vratMenoAgenta(int $zmluvaId)
    {
        $sql = "SELECT
                    CONCAT(name_first,' ',name_last) AS meno
                FROM 
                    agent a
                JOIN
                    zmluva_agent za ON za.agent_id=a.id
                WHERE
                    za.zmluva_id = {$zmluvaId}";

        return Yii::$app->db->createCommand($sql)->queryScalar();
    }

}