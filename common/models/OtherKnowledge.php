<?php
namespace common\models;

use yii\db\ActiveRecord;

class OtherKnowledge extends ActiveRecord
{
    public static function tableName()
    {
        return 'other_knowledge';
    }
}