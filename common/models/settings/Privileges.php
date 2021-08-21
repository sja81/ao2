<?php
namespace common\models\settings;

use yii\db\ActiveRecord;

class Privileges extends ActiveRecord
{
    public static function tableName()
    {
        return 'privileges';
    }
}