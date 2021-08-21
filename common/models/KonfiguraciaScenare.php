<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

class KonfiguraciaScenare extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'konfiguracia_scenare';
    }

    public static function getNextUrl(int $contractId, int $step)
    {

        return Yii::$app->db->createCommand("
            select 
                  ks.url
            from  
               nehnutelnost n
            join
               zmluva_nehnut zn on zn.nehnut_id=n.id
            join
               konfiguracia_scenare ks on ks.nehnut_kategoria_id=n.kategoria
            WHERE
                zn.zmluva_id=:id and ks.krok=:krok")
            ->bindValues([
                ':id'   => $contractId,
                ':krok' => $step
            ])
            ->queryScalar();
    }


}