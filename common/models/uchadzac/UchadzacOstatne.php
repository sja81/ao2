<?php


namespace common\models\uchadzac;


use yii\db\ActiveRecord;

class UchadzacOstatne extends ActiveRecord
{
    public static function tableName()
    {
        return 'uchadzac_ostatne';
    }
}