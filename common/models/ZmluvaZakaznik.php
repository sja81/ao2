<?php
namespace common\models;

use yii\db\ActiveRecord;

class ZmluvaZakaznik extends ActiveRecord
{
    public static function tableName()
    {
        return "zmluva_zakaznik";
    }
}