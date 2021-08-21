<?php
namespace common\models\users;
use yii\db\ActiveRecord;

class PrivilegesUsers extends ActiveRecord
{
    public static function tableName(): string
    {
       return 'privilegesUsers';
    }
}