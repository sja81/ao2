<?php
namespace common\models;

use yii\db\ActiveRecord;

class Jazyk extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jazyk';
    }
}