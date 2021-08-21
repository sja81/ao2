<?php
namespace common\models;

use yii\db\ActiveRecord;

class Supplier extends ActiveRecord
{
    const WATER = 1;
    const ELECTRICITY = 2;
    const GAS = 3;
    const WASTE = 4;
    const TV = 5;
    const PHONE = 6;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'supplier';
    }

}