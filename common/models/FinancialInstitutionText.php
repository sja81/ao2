<?php
namespace common\models;

use yii\db\ActiveRecord;

class FinancialInstitutionText extends ActiveRecord
{
    const MARITAL_STATUS = 'MARITAL_STATUS';
    const EDUCATION = "EDUCATION";
    const CUSTDOCS = "CUSTDOCS";
    const LIVING = 'LIVING';
    const BONUS_FREQUENCY = 'BONUSFREQ';
    const LEGALFORM = 'LEGALFORM';
    const INDUSTRY = 'INDUSTRY';

    public static function tableName()
    {
        return 'fininst_text';
    }
}