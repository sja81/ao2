<?php
namespace backend\actions\contracts;

use common\models\Konfiguracia;
use common\models\KonfiguraciaKategorie;
use common\models\KonfiguraciaScenare;
use common\models\Nehnutelnost;
use common\models\ZmluvaNehnutelnost;
use common\models\Znacky;
use Yii;
use yii\base\Action;
use yii\helpers\Url;
use yii\web\Cookie;

class NewBathAction extends Action
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
            $cislo_byt = Yii::$app->request->cookies->getValue('cislo_bytu');
        }

        $nehnutelnostId = (ZmluvaNehnutelnost::findOne(['zmluva_id'=>$id]))->nehnut_id;
        $nehnutelnost = Nehnutelnost::findOne(['id',$nehnutelnostId]);


        return $this->controller->render("new/bath",[
            'podlaha'   => Konfiguracia::vratZoznam(KonfiguraciaKategorie::KAT_PODLAHA),
            'kurenie'   => Konfiguracia::vratZoznam(KonfiguraciaKategorie::KAT_KURENIE),
            'okno'      => Konfiguracia::vratZoznam(KonfiguraciaKategorie::KAT_OKNO),
            'basic_info'    => $nehnutelnost->zakladneInfo,
            'osvetlenie'    => Konfiguracia::vratZoznam(KonfiguraciaKategorie::KAT_OSVETLENIE),
            'nabytok'       => Konfiguracia::vratZoznam(KonfiguraciaKategorie::KAT_NABYTOK),
            'stena'         => Konfiguracia::vratZoznam(KonfiguraciaKategorie::KAT_STENA),
            'vana'          => Konfiguracia::vratZoznam(KonfiguraciaKategorie::KAT_VANA),
            'sprcha'        => Konfiguracia::vratZoznam(KonfiguraciaKategorie::KAT_SPRCHA),
            'povrch_steny' => Konfiguracia::vratZoznam(KonfiguraciaKategorie::KAT_POVRCH_STENY),
            'toaleta'      => Konfiguracia::vratZoznam(KonfiguraciaKategorie::KAT_TOALETA),
            'vana_znacka'   => Znacky::vratZoznam(Znacky::VANA),
            'toaleta_znacka'    => Znacky::vratZoznam(Znacky::TOALETA),
            'toaleta_typ'   => Konfiguracia::vratZoznam(KonfiguraciaKategorie::KAT_TOALETA_TYP),
            'sprcha_funkcia' => Konfiguracia::vratZoznam(KonfiguraciaKategorie::KAT_SPRCHA_FUNKCIA),
            'vana_funkcia'  => Konfiguracia::vratZoznam(KonfiguraciaKategorie::KAT_VANA_FUNKCIA),
            'sprcha_znacka' => Znacky::vratZoznam(Znacky::SPRCHA),
        ]);
    }
}