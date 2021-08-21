<?php


namespace common\models\uchadzac;


use yii\db\ActiveRecord;

class UchadzacZnalosti extends ActiveRecord
{
    public static function tableName()
    {
        return 'uchadzac_znalosti';
    }
}