<?php

namespace common\models;

use yii\db\ActiveRecord;

class PrivilegesTemplates extends ActiveRecord
{
    protected $userFuncAttendance = 0;

    public static function tableName()
    {
        return 'privileges_templates';
    }

    public static function userFunctionText(int $id): string 
    {
       $func = [
            0 => 'userFuncAttendance',
       ];

       return $func[$id];
    }
}