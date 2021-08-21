<?php
namespace common\models\client;

use yii\db\ActiveRecord;

class ClientDocumentFiles extends ActiveRecord
{
    public static function tableName()
    {
        return 'client_document_files';
    }
    
}