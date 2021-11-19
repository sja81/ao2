<?php
namespace common\models\schools;

use yii\db\ActiveRecord;

class StudentTests extends ActiveRecord
{
    const TESTTYPE_PERSONAL = 'persona';
    const TESTTYPE_IQ = 'iq';
    const TESTTYPE_AQ = 'aq';
    const TESTTYPE_VIDEO = 'video';
    const TESTTYPE_WRITE = 'write';
    const TESTTYPE_LANGUAGE = 'lang';
    const TESTTYPE_DEV = 'dev';

    public static function tableName()
    {
        return 'studentTests';
    }
}