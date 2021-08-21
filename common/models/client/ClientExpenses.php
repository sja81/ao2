<?php
namespace common\models\client;

use yii\db\ActiveRecord;

class ClientExpenses extends ActiveRecord
{
    public static function tableName()
    {
        return 'client_expenses';
    }

}