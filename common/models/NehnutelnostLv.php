<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

class NehnutelnostLv extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nehnut_lv';
    }

    public static function loadLvData($cislo)
    {
        $sql = "select id from nehnut_dokumenty where status=1 and dokument_typ='LV' and zmluva_cislo={$cislo}";
        $dokId = Yii::$app->db->createCommand($sql)->queryScalar();

        $sql = "select data from nehnut_lv where dok_id={$dokId} and status=1";
        $data = Yii::$app->db->createCommand($sql)->queryScalar();

        return json_decode($data, true);
    }

    public static function getByt($cislo, $i)
    {
        $data = self::loadLvData($cislo);

        return $data['BYTY'][$i];
    }

}