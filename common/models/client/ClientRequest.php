<?php
namespace common\models\client;

use yii\db\ActiveRecord;
use yii\db\Expression;

class ClientRequest extends ActiveRecord
{
    const REQ_SALT = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.';

    public static function tableName()
    {
        return 'client_request';
    }
}