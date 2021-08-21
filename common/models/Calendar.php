<?php
namespace common\models;

use yii\db\ActiveRecord;

class Calendar extends ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'calendar';
    }

}