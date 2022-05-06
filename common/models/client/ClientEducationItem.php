<?php

namespace common\models\client;

use yii\db\ActiveRecord;

class ClientEducationItem extends ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName(): string
    {
        return 'client_education_item';
    }
}