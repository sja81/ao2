<?php
namespace common\models;

use yii\db\ActiveRecord;
use Yii;

class WordCollection extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'word_collection';
    }

    public function getPrimaryText(int $lang): string
    {
        return Yii::$app->db->createCommand("SELECT word FROM word_collection WHERE prime=1 AND status=1")->queryScalar();
    }

    public function getTexts(int $lang): array
    {
        $sql = "SELECT word FROM word_collection WHERE status=1 AND lang=:id";
        return Yii::$app->db->createCommand($sql)->bindValue(':id',$lang)->queryAll();
    }

}