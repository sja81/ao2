<?php
namespace common\models;

use yii\db\ActiveRecord;

class NehnutelnostKuchyna extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nehnut_kuchyna';
    }

    public function pridajKuchynu(array $data, int $nehnutId)
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
            'povrch',
            'stena_farba',
            'kuchyn_link_znacka',
            'kuchyn_link_material',
            'chladnicka_znacka',
            'mraznicka_znacka',
            'klima_znacka',
            'susicka_znacka',
            'digestor_znacka',
            'mikrovlnka_znacka',
            'kuchyn_link_pracdosk_farba',
            'kuchyn_link_material_farba',
            'kuchyn_link_pracdosk',
            'sporak_znacka',
            'pracka_znacka',
            'umyv_riad_znacka'
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

        if (isset($data['kuchyn_link_znacka'])) {
            Znacky::ulozZnacku($data,'kuchyn_link_znacka', Znacky::KUCH_LINKA);
        }

        if (isset($data['chladnicka_znacka'])) {
            Znacky::ulozZnacku($data,'chladnicka_znacka', Znacky::CHLADNICKA);
        }

        if (isset($data['mraznicka_znacka'])) {
            Znacky::ulozZnacku($data,'mraznicka_znacka', Znacky::MRAZNICKA);
        }

        if (isset($data['klima_znacka'])) {
            Znacky::ulozZnacku($data,'klima_znacka', Znacky::KLIMA);
        }

        if (isset($data['susicka_znacka'])) {
            Znacky::ulozZnacku($data,'susicka_znacka', Znacky::SUSICKA);
        }

        if (isset($data['digestor_znacka'])) {
            Znacky::ulozZnacku($data,'digestor_znacka', Znacky::DIGESTOR);
        }

        if (isset($data['mikrovlnka_znacka'])) {
            Znacky::ulozZnacku($data,'mikrovlnka_znacka', Znacky::MIKROVLNKA);
        }

        if (isset($data['sporak_znacka'])) {
            Znacky::ulozZnacku($data,'sporak_znacka', Znacky::SPORAK);
        }

        if (isset($data['pracka_znacka'])) {
            Znacky::ulozZnacku($data,'pracka_znacka', Znacky::PRACKA);
        }

        if (isset($data['umyv_riad_znacka'])) {
            Znacky::ulozZnacku($data,'umyv_riad_znacka', Znacky::UMYV_RIAD);
        }

        if (isset($data['kuchyn_link_material'])) {
            // uloz material do konfiguracie
            Konfiguracia::ulozKonfiguraciu($data, 'kuchyn_link_material', KonfiguraciaKategorie::KAT_KUCH_LINKA_MATERIAL);
        }

        if (isset($data['kuchyn_link_pracdosk'])) {
            // uloz pracovnu dosku do konfiguracie
            Konfiguracia::ulozKonfiguraciu($data, 'kuchyn_link_pracdosk', KonfiguraciaKategorie::KAT_KUCH_LINKA_PRAC_DOSKA);
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