<?php
namespace common\models;


use yii\db\ActiveRecord;

class Ucel extends ActiveRecord
{
    const STATUS_ACTIVE = 1;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ucel';
    }

    public static function getVsetkyUcely()
    {
        return self::find()->select(['id','name'])->where(['=',"status",self::STATUS_ACTIVE])->asArray()->all();
    }
}