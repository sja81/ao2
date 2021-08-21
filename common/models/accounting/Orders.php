<?php
namespace common\models\accounting;

use yii\db\ActiveRecord;

class Orders extends ActiveRecord
{
    public static function tableName()
    {
        return 'orders';
    }

    public function getOrderNumber()
    {
        return $this->order_sign .''.$this->order_number;
    }

    public function getSuppliers()
    {
        return $this->hasOne(\common\models\accounting\OrderSupplier::class,[]);
    }

    public function getNextOrderNumber(Office $office)
    {

        return $office->invoice_sign;
    }
}