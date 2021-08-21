<?php
namespace common\models\uchadzac;

use yii\db\ActiveRecord;

class UchadzacZamestnaniePolozky extends ActiveRecord
{
    public static function tableName()
    {
        return 'uchadzac_zamestnanie_polozky';
    }

}