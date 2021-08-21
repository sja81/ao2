<?php
namespace common\models\users;

use yii\db\ActiveRecord;

class UserGroups extends ActiveRecord
{
    public static function tableName()
    {
        return 'auth_item';
    }
}