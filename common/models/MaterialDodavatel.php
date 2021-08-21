<?php
namespace common\models;

use yii\db\ActiveRecord;

class MaterialDodavatel extends ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName()
    {
        return 'material_dodavatel';
    }


}