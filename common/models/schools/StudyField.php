<?php
namespace common\models\schools;

use yii\db\ActiveRecord;

class StudyField extends ActiveRecord
{
    public static function tableName()
    {
        return 'studyField';
    }
}