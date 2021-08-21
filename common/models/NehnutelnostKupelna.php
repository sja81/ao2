<?php
namespace common\models;

use yii\db\ActiveRecord;

class NehnutelnostKupelna extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nehnut_kupelna';
    }

    public function pridajKupelnu(array $data, int $nehnutId)
    {
        $toSkip = [
            'zmluva_id',
            'property_id'
        ];

        $arrayTyp = [
            'podlaha',
            'kurenie',
            'okno',
            'nabytok',
            'osvetlenie',
            'stena',
            'stena_farba',
            'toaleta_znacka',
            'sprcha_znacka',
            'vana_znacka',
            'vana_funkcia',
            'sprcha_funkcia',
            'toaleta_typ',
            'vana',
            'sprchovy_kut'
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

        if (!$result) {
            throw new Exception('Nemozem ulozit informaciu o miestnosti', 401);
        }

        if (isset($data['toaleta_znacka'])) {
            Znacky::ulozZnacku($data,'toaleta_znacka', Znacky::TOALETA);
        }

        if (isset($data['sprcha_znacka'])) {
            Znacky::ulozZnacku($data,'sprcha_znacka', Znacky::SPRCHA);
        }

        if (isset($data['vana_znacka'])) {
            Znacky::ulozZnacku($data,'vana_znacka', Znacky::VANA);
        }

        if (isset($data['vana'])) {
            Konfiguracia::ulozKonfiguraciu($data, 'vana', KonfiguraciaKategorie::KAT_VANA);
        }
        if (isset($data['sprchovy_kut'])) {
            Konfiguracia::ulozKonfiguraciu($data, 'sprchovy_kut', KonfiguraciaKategorie::KAT_SPRCHA);
        }
        if (isset($data['vana_funkcia'])) {
            Konfiguracia::ulozKonfiguraciu($data, 'vana_funkcia', KonfiguraciaKategorie::KAT_VANA_FUNKCIA);
        }
        if (isset($data['sprcha_funkcia'])) {
            Konfiguracia::ulozKonfiguraciu($data, 'sprcha_funkcia', KonfiguraciaKategorie::KAT_SPRCHA_FUNKCIA);
        }

        if (isset($data['podlaha'])) {
            Konfiguracia::ulozKonfiguraciu($data,'podlaha',KonfiguraciaKategorie::KAT_PODLAHA);
        }
        if (isset($data['kurenie'])) {
            Konfiguracia::ulozKonfiguraciu($data, 'kurenie', KonfiguraciaKategorie::KAT_KURENIE);
        }
        if (isset($data['okno'])) {
            Konfiguracia::ulozKonfiguraciu($data, 'okno', KonfiguraciaKategorie::KAT_OKNO);
        }
        if (isset($data['nabytok'])) {
            Konfiguracia::ulozKonfiguraciu($data, 'nabytok', KonfiguraciaKategorie::KAT_NABYTOK);
        }
        if (isset($data['osvetlenie'])) {
            Konfiguracia::ulozKonfiguraciu($data, 'osvetlenie', KonfiguraciaKategorie::KAT_OSVETLENIE);
        }
        if (isset($data['stena'])) {
            Konfiguracia::ulozKonfiguraciu($data, 'stena', KonfiguraciaKategorie::KAT_STENA);
        }

    }
}