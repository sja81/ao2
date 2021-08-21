<?php
namespace common\models;

use yii\db\ActiveRecord;

class CashReceipt extends ActiveRecord
{
    const PENDING = 0;
    const PAID = 1;
    const CANCELLED = 2;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pokladnicny_doklad';
    }

    public function getDodavatel()
    {
        return $this->hasOne(CashReceiptSupplier::class, ['doklad_id'=>'id']);
    }

    public function getOdberatel()
    {
        return $this->hasOne(CashReceiptCustomer::class,['doklad_id'=>'id']);
    }

    public function getStatusText()
    {
        $text = [
            0   =>  'Čaká na splatenie',
            1   =>  'Splatené',
            2   =>  'Zrušené',
        ];
        return $text[$this->status];
    }
}