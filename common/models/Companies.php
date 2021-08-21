<?php
namespace common\models;

use yii\db\ActiveRecord;

class Companies extends ActiveRecord
{
    public static function tableName()
    {
        return 'companies';
    }

}