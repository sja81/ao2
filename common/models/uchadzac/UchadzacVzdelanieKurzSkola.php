<?php
namespace common\models\uchadzac;

use yii\db\ActiveRecord;

class UchadzacVzdelanieKurzSkola extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'uchadzac_vzdelanie_kurz_skola';
    }
}