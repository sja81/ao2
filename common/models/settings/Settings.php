<?php
namespace common\models\settings;

use Yii;
use yii\helpers\ArrayHelper;

class Settings
{
    const CRM_FINANCIAL_QUESTIONARY_REQUESTS = 'CRM_FINQUEST_REQ';
    const CRM_CALC_LIMITS = 'CRM_CALC_LIMITS';


    public static function getValue(string $key, int $langId)
    {
        $sql = "SELECT * FROM settings WHERE category='{$key}' and status=1 and lang_id={$langId}";
        return Yii::$app->db->createCommand($sql)->queryAll();
    }

    public static function getFinancialQuestionaryRequests(int $langId=1)
    {
        return static::getValue(static::CRM_FINANCIAL_QUESTIONARY_REQUESTS, $langId);
    }

    public static function getFinancialQuestionaryCalcLimits(int $langId=1)
    {
        $limits = static::getValue(static::CRM_CALC_LIMITS, $langId);
        return ArrayHelper::map($limits,'field_name','field_value');
    }
}