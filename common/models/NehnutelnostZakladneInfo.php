<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

class NehnutelnostZakladneInfo extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nehnut_zaklady';
    }

    public function updatePodmienky(array $data)
    {
        if (isset($data['podmienka_prevod'])) {
            $this->podmienka_prevod = implode(",",$data['podmienka_prevod']);
        }

        if (isset($data['podmienka_prenajom'])) {
            $this->podmienka_prenajom = implode(",",$data['podmienka_prenajom']);
        }

        $result = $this->save();

        if (!$result) {
            throw new Exception('Nemozem ulozit zakladne informacie o nehnutelnosti', 401);
        }
    }

    /**
     * @param array $data
     */
    public function ulozZakladneInformacie(array $data)
    {

        $toSkip = [
            'zmluva_id',
            'naklady',
            'step'
        ];

        $arrayTyp = [
            'financovanie',
            'fasada_material',
            'fasada_izolacia',
            'stena',
            'okno',
            'podlaha',
            'bezp_system',
            'ohrev_voda',
            'vykurovanie',
            'stena_znacka',
            'dvere_znacka',
            'plyn_znacka',
            'elektrina_znacka',
            'pevna_linka_znacka',
            'satelit_znacka',
            'znacka_tv',
            'kurenie',
            'internet_znacka',
            'strecha_typ',
            'strecha_material',
            'strecha_izolacia',
            'plot'
        ];
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
            throw new Exception('Nemozem ulozit zakladne informacie o nehnutelnosti', 401);
        }

        // uloz stena_znacka ak neexsituje
        if (isset($data['stena_znacka'])) {
            Znacky::ulozZnacku($data,'stena_znacka', Znacky::STENA_MATERIAL);
        }
        if (isset($data['dvere_znacka'])) {
            Znacky::ulozZnacku($data, 'dvere_znacka', Znacky::VCHODOVE_DVERE);
        }
        if (isset($data['plyn_znacka'])) {
            Znacky::ulozZnacku($data, 'plyn_znacka', Znacky::PLYN);
        }
        if (isset($data['elektrina_znacka'])) {
            Znacky::ulozZnacku($data, 'elektrina_znacka', Znacky::ELEKTRINA);
        }
        if (isset($data['pevna_linka_znacka'])) {
            Znacky::ulozZnacku($data, 'pevna_linka_znacka', Znacky::PEVNA_LINKA);
        }
        if (isset($data['satelit_znacka'])) {
            Znacky::ulozZnacku($data, 'satelit_znacka', Znacky::SATELIT);
        }
        if (isset($data['znacka_tv'])) {
            Znacky::ulozZnacku($data, 'znacka_tv', Znacky::KABLOVA_TV);
        }
        if (isset($data['internet_znacka'])) {
            Znacky::ulozZnacku($data, 'internet_znacka', Znacky::INTERNET);
        }

    }

    public static function vratZakladneInformacie(int $id)
    {
        return Yii::$app->db->createCommand("select * from nehnut_zaklady where nehnut_id={$id}")->queryOne();
    }

}