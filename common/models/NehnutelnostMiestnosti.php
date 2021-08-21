<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

class NehnutelnostMiestnosti extends ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nehnut_miestnosti';
    }

    public function pridajMiestnost(array $data, int $nehnutId)
    {
        $toSkip = [
            'property_id'
        ];

        $arrayTyp = [
            'podlaha',
            'kurenie',
            'okno',
            'nabytok',
            'osvetlenie',
            'stena',
            'stena_farba'
        ];

        $this->property_id = $nehnutId;

        foreach ($data as $key=>$value) {
             if (in_array($key, $toSkip) || (in_array($key, $arrayTyp) && !isset($data[$key]))) {
                continue;
            }
            $items = null;
            if (in_array($key,$arrayTyp)) {
                $items = implode(',',$value);
            } else {
                $items= $value;
            }
            if (!is_null($items)) {
                $this->$key = $items;
            }
        }

        $result = $this->save();

        // uloz este neexistujuce konfiguracie
        if (isset($data['podlaha']) && is_array($data['podlaha'])) {
            Konfiguracia::ulozKonfiguraciu($data,'podlaha',KonfiguraciaKategorie::KAT_PODLAHA);
        }
        if (isset($data['kurenie']) && is_array($data['kurenie'])) {
            Konfiguracia::ulozKonfiguraciu($data, 'kurenie', KonfiguraciaKategorie::KAT_KURENIE);
        }
        if (isset($data['okno']) && is_array($data['okno'])) {
            Konfiguracia::ulozKonfiguraciu($data, 'okno', KonfiguraciaKategorie::KAT_OKNO);
        }
        if (isset($data['nabytok']) && is_array($data['nabytok'])) {
            Konfiguracia::ulozKonfiguraciu($data, 'nabytok', KonfiguraciaKategorie::KAT_NABYTOK);
        }
        if (isset($data['osvetlenie']) && is_array($data['osvetlenie'])) {
            Konfiguracia::ulozKonfiguraciu($data, 'osvetlenie', KonfiguraciaKategorie::KAT_OSVETLENIE);
        }
        if (isset($data['stena']) && is_array($data['stena'])) {
            Konfiguracia::ulozKonfiguraciu($data, 'stena', KonfiguraciaKategorie::KAT_STENA);
        }

        if (!$result) {
            throw new Exception('Nemozem ulozit informaciu o miestnosti', 401);
        }
    }

    public static function vratMiestnosti(int $nehnutId)
    {
        $sql = "SELECT 
                    k.nazov,
                    nm.plocha,
                    nm.sirka,
                    nm.dlzka
                FROM 
                    nehnut_miestnosti nm
                JOIN
                    konfiguracia k ON nm.nazov=k.id AND k.kategoria_id=4
                WHERE 
                    nm.property_id={$nehnutId}";

        return Yii::$app->db->createCommand($sql)->queryAll();
    }

}