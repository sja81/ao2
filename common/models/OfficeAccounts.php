<?php
namespace common\models;

use yii\db\ActiveRecord;

class OfficeAccounts extends ActiveRecord
{
    public static function tableName()
    {
        return 'office_accounts';
    }

    public function getDetails()
    {
        return $this->hasOne(FinancialInstitution::class, ['id'=>'bank_id']);
    }
}