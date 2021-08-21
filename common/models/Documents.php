<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

class Documents extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'documents';
    }

    public function getDocumentsByPropertyCategory(int $contract_id)
    {
        $kategoria = (Nehnutelnost::findOne(['id'=>(ZmluvaNehnutelnost::getNehnutelnostId($contract_id))]))->kategoria;
        $sql = "
            SELECT
                nd.zmluva_id,
                nd.zmluva_cislo,
                nd.dokument,
                nd.dokument_typ,
                nd.poradie,
                doc.`name`,
                doc.multiplicity,
                doc.date_field,
                doc.sign_field,
                doc.code,
                doc.other_field,
                doc.can_gen
            FROM
                nehnut_dokumenty nd 
            JOIN 
                documents doc ON doc.`code` = nd.dokument_typ AND doc.property_category_id = {$kategoria}
            WHERE
                nd.zmluva_id = {$contract_id} AND
                nd.dokument_typ != 'LV'	AND
                nd.`status`= 1
        ";

        return Yii::$app->db->createCommand($sql)->queryAll();
    }

    public function getMissingDocuments(int $contract_id)
    {
        $kategoria = (Nehnutelnost::findOne(['id'=>(ZmluvaNehnutelnost::getNehnutelnostId($contract_id))]))->kategoria;
        $sql = "
            SELECT 
                d.name, d.code, d.multiplicity, d.date_field, d.sign_field, d.other_field, d.can_gen 
            FROM 
                documents d
            WHERE 
                d.property_category_id={$kategoria} AND 
                d.code NOT IN 
                (
                    SELECT 
                        nd.dokument_typ 
                    FROM 
                        nehnut_dokumenty nd 
                    WHERE 
                        nd.zmluva_id={$contract_id}
                )
        ";
        return Yii::$app->db->createCommand($sql)->queryAll();
    }
}