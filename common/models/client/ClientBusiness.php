<?php
namespace common\models\client;

use yii\db\ActiveRecord;

class ClientBusiness extends ActiveRecord
{
    public static function tableName()
    {
        return 'client_business';
    }
}