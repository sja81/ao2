<?php

namespace common\models;

use yii\db\ActiveRecord;

class PrivilegesTemplates extends ActiveRecord
{
    private $userFuncAttendance = 0;
    private $test = 1;

    public static function tableName()
    {
        return 'privileges_templates';
    }

    public static function userFunctionText(int $id): string 
    {
       $func = [
            0 => 'userFuncAttendance',
            1 => 'test'
       ];

       return $func[$id];
    }
}