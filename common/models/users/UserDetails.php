<?php

namespace common\models\users;

use yii\db\ActiveRecord;

class UserDetails extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'userDetails';
    }
}