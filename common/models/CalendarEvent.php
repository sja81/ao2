<?php

namespace common\models;

use yii\db\ActiveRecord;

class CalendarEvent extends ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'calendarEvent';
    }

    public function rules()
    {
        return [
            [['title', 'description'], 'string'],
            [['title', 'description', 'eventTypeId'], 'safe']
        ];
    }
}
