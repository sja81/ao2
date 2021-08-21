<?php
namespace common\models\accounting;

use yii\db\ActiveRecord;

class OrderSupplier extends ActiveRecord
{
    public static function tableName()
    {
        return 'orders_supplier';
    }
}