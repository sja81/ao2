<?php
namespace common\models\users;

use yii\db\ActiveRecord;

class UserWork extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'userWork';
    }
}