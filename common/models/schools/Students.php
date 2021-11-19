<?php
namespace common\models\schools;

use yii\db\ActiveRecord;

class Students extends ActiveRecord
{
    const STATUS_PENDING = 0;
    const STATUS_PROCESSED = 1;
    const STATUS_ACCEPTED = 2;
    const STATUS_NOTACCEPTED = 3;

    public static function tableName()
    {
        return 'student';
    }

    public function getFullName()
    {
        return $this->firstName . ' ' . $this->lastName;
    }

}