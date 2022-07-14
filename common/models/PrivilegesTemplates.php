<?php

namespace common\models;

use yii\db\ActiveRecord;

class PrivilegesTemplates extends ActiveRecord
{
    public static function tableName()
    {
        return 'privileges_templates';
    }
}