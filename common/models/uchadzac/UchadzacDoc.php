<?php
namespace common\models\uchadzac;

use yii\db\ActiveRecord;

class UchadzacDoc extends ActiveRecord
{
    const NO_PICS = 'no-user.jpg';
    const DOCTYPE_PHOTO = 'photo';
    const DOCTYPE_CV = 'cv';
    const DOCTYPE_MOTIVATIONLETTER = 'motivationletter';

    public static function tableName()
    {
        return 'uchadzac_doc';
    }
}