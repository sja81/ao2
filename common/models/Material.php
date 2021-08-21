<?php
namespace common\models;

use yii\db\ActiveRecord;

class Material extends ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName()
    {
        return 'material';
    }

    public function getStock()
    {
        return $this->hasMany(Stock::class,['material_id'=>'id']);
    }
}