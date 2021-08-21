<?php
namespace common\models\client;

use yii\db\ActiveRecord;

class ClientContact extends ActiveRecord
{
    public static function tableName()
    {
        return 'client_contact';
    }
}