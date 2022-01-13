<?php
namespace common\models\property;

use yii\db\ActiveRecord;
use common\models\NehnutelnostDruhy;

class Offer extends ActiveRecord
{
    const OWNER_GENDER_MALE = 0;
    const OWNER_GENDER_FEMALE = 1;
    const STATUS_PENDING = 0;
    const STATUS_PROCESSED = 1;
    const STATUS_DELETED = 2;
    const INFORMED_NO = 0;
    const INFORMED_PLANNED = 1;
    const INFORMED_YES = 2;

    public static function tableName()
    {
        return 'offer';
    }

    public function getPropertyType()
    {
        return $this->hasOne(NehnutelnostDruhy::class,[]);
    }

    public function getFullName()
    {
        return $this->name . ' ' . $this->lastName;
    }
}