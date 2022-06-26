<?php
namespace common\models\users;

use yii\db\ActiveRecord;

class UserFile extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_files';
    }
}