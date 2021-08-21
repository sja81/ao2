<?php
namespace common\models;

use yii\db\ActiveRecord;

class KonfiguraciaKategorie extends ActiveRecord
{

    const KAT_BEZPECNOST            = 1;
    const KAT_FINANCOVNIE           = 2;
    const KAT_INTERNET              = 3;
    const KAT_NAZOV_IZBA            = 4;
    const KAT_KURENIE               = 5;
    const KAT_FASADA                = 6;
    const KAT_STRECHA_MAT           = 7;
    const KAT_NABYTOK               = 8;
    const KAT_CERT                  = 9;
    const KAT_OBJ_STAV              = 10;
    const KAT_VLASTNICTVO           = 11;
    const KAT_ZARIADENOST           = 12;
    const KAT_VANA                  = 13;
    const KAT_STENA                 = 14;
    const KAT_SPRCHA                = 15;
    const KAT_OKNO                  = 16;
    const KAT_ORIENTACIA            = 17;
    const KAT_PLOT                  = 18;
    const KAT_PODLAHA               = 19;
    const KAT_PODMIENKY             = 20;
    const KAT_IZOLACIA_STRECHA      = 21;
    const KAT_VCHODOVE_DVERE        = 22;
    const KAT_OSVETLENIE            = 23;
    const KAT_OHREV_VODY            = 24;
    const KAT_STRECHA_TYP           = 25;
    const KAT_FASADA_ZATEP          = 26;
    const KAT_VYKUROVANIE           = 27;
    const KAT_POVRCH_STENY          = 28;
    const KAT_VANA_FUNKCIA          = 29;
    const KAT_SPRCHA_FUNKCIA        = 30;
    const KAT_TOALETA               = 31;
    const KAT_TOALETA_TYP           = 32;
    const KAT_KUCH_LINKA_MATERIAL   = 33;
    const KAT_KUCH_LINKA_PRAC_DOSKA = 34;
    const KAT_SOC_SIETE             = 35;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'konfiguracia_kategorie';
    }
}