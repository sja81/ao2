<?php

namespace common\models\users;

use Yii;

use yii\db\ActiveRecord;

class UsersStats extends ActiveRecord
{
    const ACTION_LOGIN = 'login';
    const ACTION_LOGOUT = 'logout';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usersStats';
    }
}