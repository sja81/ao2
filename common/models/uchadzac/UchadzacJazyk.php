<?php


namespace common\models\uchadzac;

use common\models\Jazyk;
use yii\db\ActiveRecord;

class UchadzacJazyk extends ActiveRecord
{
    private $langLevel = [
       1 => 'Úplný začiatočník (A1)',
       2 => 'Začiatočník (A2)',
       3 => 'Mierne pokročilý (B1)',
       4 => 'Stredne pokročilý (B2)',
       5 => 'Pokročilý (C1)',
       6 => 'Expert (C2)',
       7 => 'Materinský jazyk',
    ];

    public static function tableName()
    {
        return 'uchadzac_jazyk';
    }

    public function getLanguageInfo()
    {
        return $this->hasOne(Jazyk::class,['id'=>'jazyk_id']);
    }

    public function getLevelText()
    {
        return $this->langLevel[$this->uroven];
    }
}