<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

class Operator extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'operator';
    }

    public static function getUTO(int $krajinaId)
    {
        $sql = "select operator_kod from operator where stat_id=:id and status=1";

        return Yii::$app->db->createCommand($sql)->bindValue(':id', $krajinaId)->queryAll();
    }
}