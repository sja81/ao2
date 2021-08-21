<?php
namespace common\models\client;

use yii\db\ActiveRecord;

class ClientDocuments extends ActiveRecord
{
    public static function tableName()
    {
        return 'client_documents';
    }
}