<?php
namespace common\models\schools;

use yii\db\ActiveRecord;

class StudentLanguage extends ActiveRecord
{
    public static function tableName()
    {
        return 'studentLanguage';
    }
}