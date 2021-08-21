<?php
namespace common\models\client;

use yii\db\ActiveRecord;

class ClientReferal extends ActiveRecord
{
    public static function tableName()
    {
        return 'client_referal';
    }
}