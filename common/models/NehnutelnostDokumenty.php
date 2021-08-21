<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

final class NehnutelnostDokumenty extends ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nehnut_dokumenty';
    }

    public static function exists($contractNumber, $docType, $poradie=1)
    {
        $sql = "select count(id) from nehnut_dokumenty where zmluva_cislo='{$contractNumber}' and dokument_typ='{$docType}' and status=1 and poradie={$poradie}";
        return Yii::$app->db->createCommand($sql)->queryScalar() > 0;
    }

}