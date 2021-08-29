<?php
namespace common\models\schools;

use yii\db\ActiveRecord;

class School extends ActiveRecord
{
    public static function tableName()
    {
        return 'school';
    }
}