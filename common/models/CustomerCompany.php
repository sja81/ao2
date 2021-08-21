<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

class CustomerCompany extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customer_company';
    }
}