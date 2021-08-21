<?php
namespace common\models\client;

use yii\db\ActiveRecord;

class ClientOtherIncomes extends ActiveRecord
{
    public static function tableName()
    {
        return 'client_other_incomes';
    }
}