<?php
namespace common\models\uchadzac;

use yii\db\ActiveRecord;

class UchadzacZamestnanie extends ActiveRecord
{
    public static function tableName()
    {
        return 'uchadzac_zamestnanie';
    }
}