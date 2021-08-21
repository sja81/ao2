<?php
namespace common\models;


use yii\db\ActiveRecord;

class NehnutelnostObrazok extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nehnut_obrazky';
    }
}