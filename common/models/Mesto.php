<?php


namespace common\models;

use Yii;
use yii\db\ActiveRecord;

class Mesto extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mesto';
    }

    public static function getPsc($nazov)
    {
        $sql = "select psc from mesto where nazov_obce='{$nazov}'";
        return Yii::$app->db->createCommand($sql)->queryScalar();
    }

    public static function getKrajina($nazov)
    {
        $sql = "select stat.`name` from stat join mesto on mesto.stat_id=stat.id where mesto.nazov_obce='{$nazov}'";

        return Yii::$app->db->createCommand($sql)->queryScalar();
    }

    public static function getKraj($nazov)
    {
        $sql = "select kraj.`name` from kraj join mesto on mesto.kraj_id=kraj.id where mesto.nazov_obce='{$nazov}'";

        return Yii::$app->db->createCommand($sql)->queryScalar();
    }

    public static function getId($nazov)
    {
        $sql = "select id from mesto where mesto.nazov_obce='{$nazov}'";
        return Yii::$app->db->createCommand($sql)->queryScalar();
    }

    public static function isMesto(string $nazov)
    {
        return Yii::$app
            ->db
            ->createCommand("select count(id) from mesto where nazov_obce=:s")
            ->bindValue(':s', $nazov)
            ->queryScalar();
    }
}