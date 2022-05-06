<?php

namespace common\models\client;

use yii\db\ActiveRecord;

class ClientEducation extends ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName(): string
    {
        return 'client_education';
    }

    public function getEducationItems()
    {
        return $this->hasMany(ClientEducationItem::class,['client_education_id'=>'id']);
    }
}