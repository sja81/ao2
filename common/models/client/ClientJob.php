<?php
namespace common\models\client;

use yii\db\ActiveRecord;

class ClientJob extends ActiveRecord
{
    public static function tableName()
    {
        return 'client_jobs';
    }
}