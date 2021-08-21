<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

class Konfiguracia extends ActiveRecord
{

    const STAT_ACTIVE               = 1;
    const STAT_DISABLED             = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'konfiguracia';
    }

    /**
     * @param int $kategoria
     * @param string $hodnota
     * @return array
     */
    public static function vratZoznam(int $kategoria, string $hodnota=null)
    {
        $result = self::find()->andWhere(['=','kategoria_id',$kategoria])->andWhere(['=','status',1]);
        if (!is_null($hodnota)) {
            $result->andWhere(['=','hodnota',$hodnota]);
        }
        return $result->asArray()->all();
    }

    public static function vratNazov(int $id=null)
    {
        if (is_null($id)) {
            return "";
        }
        return Yii::$app->db->createCommand("select nazov from konfiguracia where id={$id}")->queryScalar();
    }

    public static function ulozKonfiguraciu(array $data, string $konfiguracia, int $kategoria)
    {
        foreach ($data[$konfiguracia] as $item) {
            if (is_int($item)) {
                continue;
            }
            if (!self::existujeKonfiguracia($item, $kategoria)) {
                Yii::$app->db->createCommand("INSERT INTO konfiguracia (`kategoria_id`,`nazov`,`status`) VALUES ({$kategoria},'{$item}',1)")->execute();
            }
        }
    }

    private static function existujeKonfiguracia(string $konfiguracia, int $kategoria)
    {
        return Yii::$app
            ->db
            ->createCommand("
                    SELECT 
                        count(id) 
                    FROM 
                        konfiguracia 
                    WHERE 
                        status=1 AND 
                        kategoria_id={$kategoria} AND 
                        nazov='{$konfiguracia}'
            ")
            ->queryScalar();
    }

}