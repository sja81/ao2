<?php
namespace common\models;


use yii\db\ActiveRecord;

class AcademicDegrees extends ActiveRecord
{

    const STATUS_ACTIVE = 1;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'academic_degrees';
    }

    private function getActiveItems()
    {
        return self::find()->where(['=','status',self::STATUS_ACTIVE]);
    }

    public function getTitulPredMenom()
    {
        return self::getActiveItems()->where(['=','before_name',1])->asArray()->all();
    }

    public function getTitulZaMenom()
    {
        return self::getActiveItems()->where(['=','after_name',1])->asArray()->all();
    }

}