<?php
namespace common\models\users;

use Yii;
use yii\db\ActiveRecord;

class UserAttendance extends ActiveRecord
{
    const PRICHOD = 1;
    const ODCHOD = 2;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'userAttendance';
    }
}
