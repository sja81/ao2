<?php
namespace common\models;

use yii\db\ActiveRecord;

class PostSlice extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post_slice';
    }
}