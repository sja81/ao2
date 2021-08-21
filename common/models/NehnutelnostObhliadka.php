<?php
namespace common\models;

use yii\db\ActiveRecord;

class NehnutelnostObhliadka extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nehnut_obhliadka';
    }
}