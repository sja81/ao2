<?php
namespace common\models\client;

use yii\db\ActiveRecord;

class ClientDetail extends ActiveRecord
{
    public static function tableName()
    {
        return 'client_detail';
    }
}