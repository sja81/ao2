<?php
namespace common\models\schools;

use yii\db\ActiveRecord;

class StudentLegalRepresentative extends ActiveRecord
{
    public static function tableName()
    {
        return 'studentLegalRepresentative';
    }
}