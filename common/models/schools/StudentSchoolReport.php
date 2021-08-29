<?php
namespace common\models\schools;

use yii\db\ActiveRecord;

class StudentSchoolReport extends ActiveRecord
{
    public static function tableName()
    {
        return 'studentSchoolReport';
    }
}