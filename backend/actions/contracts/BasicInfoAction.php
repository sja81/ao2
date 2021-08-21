<?php
namespace backend\actions\contracts;

use common\models\KonfiguraciaScenare;
use common\models\Konfiguracia;
use common\models\KonfiguraciaKategorie;
use common\models\NehnutelnostLv;
use common\models\Znacky;
use yii\base\Action;
use Yii;
use yii\helpers\Url;
use yii\web\Cookie;

class BasicInfoAction extends Action
{
    public function run(int $id)
    {
        if (is_null(Yii::$app->user->identity)) {
            return $this->controller->redirect(Url::to(['/site/login']));
        }

        $cislo = null;
        $cislo_byt = -1;

        if (!Yii::$app->request->cookies->getValue('zmluva-cislo')) {
            return $this->controller->redirect(Url::to(['/']));
        } else {
            $cislo = Yii::$app->request->cookies->getValue('zmluva-cislo');
            Yii::$app->response->cookies->add(new Cookie(['name'=>'krok','value'=>3]));
            $cislo_byt = Yii::$app->request->cookies->getValue('cislo_bytu');
        }

        $nextUrl = KonfiguraciaScenare::getNextUrl($id,3);

        return $this->controller->render("new/{$nextUrl}",[
            'prop_stav' => Konfiguracia::vratZoznam(KonfiguraciaKategorie::KAT_OBJ_STAV),
            'objekt_cert' => Konfiguracia::vratZoznam(KonfiguraciaKategorie::KAT_CERT),
            'typ_strecha'   => Konfiguracia::vratZoznam(KonfiguraciaKategorie::KAT_STRECHA_TYP),
            'material_strecha' => Konfiguracia::vratZoznam(KonfiguraciaKategorie::KAT_STRECHA_MAT),
            'material_fasada'  => Konfiguracia::vratZoznam(KonfiguraciaKategorie::KAT_FASADA),
            'zateplenie_fasada' => Konfiguracia::vratZoznam(KonfiguraciaKategorie::KAT_FASADA_ZATEP),
            'plot' => Konfiguracia::vratZoznam(KonfiguraciaKategorie::KAT_PLOT),
            'internet' => Konfiguracia::vratZoznam(KonfiguraciaKategorie::KAT_INTERNET),
            'orientacia' => Konfiguracia::vratZoznam(KonfiguraciaKategorie::KAT_ORIENTACIA),
            'stena' => Konfiguracia::vratZoznam(KonfiguraciaKategorie::KAT_STENA),
            'strecha_izolacia' => Konfiguracia::vratZoznam(KonfiguraciaKategorie::KAT_IZOLACIA_STRECHA),
            'vlastnictvo'   => Konfiguracia::vratZoznam(KonfiguraciaKategorie::KAT_VLASTNICTVO),
            'bezpecnost' => Konfiguracia::vratZoznam(KonfiguraciaKategorie::KAT_BEZPECNOST),
            'kurenie'   => Konfiguracia::vratZoznam(KonfiguraciaKategorie::KAT_KURENIE),
            'ohrev_vody' => Konfiguracia::vratZoznam(KonfiguraciaKategorie::KAT_OHREV_VODY),
            'zariadenost' => Konfiguracia::vratZoznam(KonfiguraciaKategorie::KAT_ZARIADENOST),
            'podlaha' => Konfiguracia::vratZoznam(KonfiguraciaKategorie::KAT_PODLAHA),
            'okno'  => Konfiguracia::vratZoznam(KonfiguraciaKategorie::KAT_OKNO),
            'vchodove_dvere' => Konfiguracia::vratZoznam(KonfiguraciaKategorie::KAT_VCHODOVE_DVERE),
            'financovanie'  => Konfiguracia::vratZoznam(KonfiguraciaKategorie::KAT_FINANCOVNIE),
            'vykurovanie'   => Konfiguracia::vratZoznam(KonfiguraciaKategorie::KAT_VYKUROVANIE),
            'cislo_byt'   => $cislo_byt,
            'byt'   => NehnutelnostLv::getByt($cislo, $cislo_byt),
            'znacka_stena'      => Znacky::vratZoznam(Znacky::STENA_MATERIAL),
            'znacka_dvere'      => Znacky::vratZoznam(Znacky::VCHODOVE_DVERE),
            'znacka_plyn'       => Znacky::vratZoznam(Znacky::PLYN),
            'znacka_elektrina'  => Znacky::vratZoznam(Znacky::ELEKTRINA),
            'znacka_pevna_linka'  => Znacky::vratZoznam(Znacky::PEVNA_LINKA),
            'znacka_satelit'      => Znacky::vratZoznam(Znacky::SATELIT),
            'znacka_tv'         => Znacky::vratZoznam(Znacky::KABLOVA_TV),
            'znacka_internet'   => Znacky::vratZoznam(Znacky::INTERNET)
        ]);
    }

}