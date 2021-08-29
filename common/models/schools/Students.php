<?php
namespace common\models\schools;

use yii\db\ActiveRecord;

class Students extends ActiveRecord
{
    public static function tableName()
    {
        return 'student';
    }
}