<?php
namespace common\models;

use yii\db\ActiveRecord;

class Applications extends ActiveRecord
{
    public static function tableName()
    {
        return 'applications';
    }
}