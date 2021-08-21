<?php
namespace common\models;

use yii\db\ActiveRecord;

class KonstantneSymboly extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'konst_symbol';
    }
}