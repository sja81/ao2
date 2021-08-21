<?php
namespace common\models;

use yii\db\ActiveRecord;

class FinancialInstitution extends ActiveRecord
{
    const BANK='bank';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'financial_institution';
    }

    public function getAllActiveBanks(bool $asArray=true)
    {
        $result = self::find()->andWhere(['=','institution_type',self::BANK]);
        if ($asArray) {
            $result->asArray();
        }
        return $result->all();
    }
}