<?php
namespace common\models;

use yii\db\ActiveRecord;

class Baliky extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'baliky';
    }

    public function getPolozky()
    {
        return $this->hasMany(BalikyPolozky::class,['id'=>'balik_id']);
    }
}