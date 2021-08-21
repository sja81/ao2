<?php
namespace common\models;

use yii\db\ActiveRecord;

class Sluzby extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sluzby';
    }
}