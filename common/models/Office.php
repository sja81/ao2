<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

class Office extends ActiveRecord
{
    public static function tableName()
    {
        return 'office';
    }

    public function getAccounts()
    {
        return $this->hasMany(OfficeAccounts::class,['office_id'=>'id']);
    }
}