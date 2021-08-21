<?php
namespace common\models;

use yii\db\ActiveRecord;

class CashReceiptCustomer extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pokladnicny_doklad_odberatel';
    }
}