<?php
namespace common\models;


use yii\db\ActiveRecord;

class NehnutKategoria extends ActiveRecord
{
    const STATUS_ACTIVE = 1;

    const BYT           = 1;
    const DOM           = 2;
    const INY_OBJEKT    = 3;
    const STAVBA        = 4;
    const POZEMOK       = 5;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nehnut_kategoria';
    }

    public static function getVsetkyKategorie()
    {
        return self::find()->select(['id','nazov'])->where(['=',"status",self::STATUS_ACTIVE])->asArray()->all();
    }

}