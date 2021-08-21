<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

class Znacky extends ActiveRecord
{
    const STENA_MATERIAL            = 1;
    const VCHODOVE_DVERE            = 2;
    const PLYN                      = 3;
    const ELEKTRINA                 = 4;
    const PEVNA_LINKA               = 5;
    const SATELIT                   = 6;
    const KABLOVA_TV                = 7;
    const INTERNET                  = 8;
    const KUCH_LINKA                = 9;
    const CHLADNICKA                = 10;
    const MRAZNICKA                 = 11;
    const KLIMA                     = 12;
    const SUSICKA                   = 13;
    const DIGESTOR                  = 14;
    const MIKROVLNKA                = 15;
    const SPORAK                    = 16;
    const PRACKA                    = 17;
    const UMYV_RIAD                 = 18;
    const TOALETA                   = 19;
    const SPRCHA                    = 20;
    const VANA                      = 21;

    public static function tableName()
    {
        return 'znacka';
    }

    /**
     * @param int $kategoria
     * @return array
     */
    public static function vratZoznam(int $kategoria): array
    {
        $result = self::find()->andWhere(['=','kategoria_id',$kategoria])->andWhere(['=','status',1]);
        return $result->asArray()->all();
    }

    public static function existujeZnacka(string $znacka, int $kategoria)
    {
        return Yii::$app
            ->db
            ->createCommand("
                    SELECT 
                        count(id) 
                    FROM 
                        znacka 
                    WHERE 
                        status=1 AND 
                        kategoria_id={$kategoria} AND 
                        nazov='{$znacka}'
            ")
            ->queryScalar();
    }

    public static function ulozZnacku(array $data, string $znacka, int $kategoria)
    {
        foreach ($data[$znacka] as $item) {
            if (is_int($item)) {
                continue;
            }
            if (!self::existujeZnacka($item, $kategoria)) {
                Yii::$app->db->createCommand("INSERT INTO znacka VALUES (null, {$kategoria},'{$item}',1)")->execute();
            }
        }
    }

}