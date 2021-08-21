<?php
namespace common\models\client;

use yii\db\ActiveRecord;

class ClientOtherExpenses extends ActiveRecord
{
    public static function tableName()
    {
        return 'client_other_expenses';
    }
}