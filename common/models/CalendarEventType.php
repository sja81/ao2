<?php

namespace common\models;

use yii\db\ActiveRecord;

class CalendarEventType extends ActiveRecord
{
    const PRAZDNINY = 1;
    const STATNY_SVIATOK = 2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'calendarEventType';
    }
}
