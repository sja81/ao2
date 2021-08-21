<?php
namespace common\models;

use yii\db\ActiveRecord;

class CashReceiptSupplier extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pokladnicny_doklad_dodavatel';
    }
}