<?php
namespace backend\actions\contracts;

use common\models\ConfigIzbaNazov;
use common\models\ConfigKurenie;
use common\models\ConfigNabytok;
use common\models\ConfigOkno;
use common\models\ConfigOsvetlenie;
use common\models\ConfigPodlaha;
use common\models\ConfigStena;
use common\models\Konfiguracia;
use common\models\KonfiguraciaKategorie;
use common\models\KonfiguraciaScenare;
use common\models\Nehnutelnost;
use common\models\ZmluvaNehnutelnost;
use Yii;
use yii\base\Action;
use yii\helpers\Url;
use yii\web\Cookie;

class NewRoomAction extends Action
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

        return $this->controller->render("new/room",[
            'podlaha'   => Konfiguracia::vratZoznam(KonfiguraciaKategorie::KAT_PODLAHA),
            'kurenie'   => Konfiguracia::vratZoznam(KonfiguraciaKategorie::KAT_KURENIE),
            'okno'      => Konfiguracia::vratZoznam(KonfiguraciaKategorie::KAT_OKNO),
            'basic_info' => $nehnutelnost->zakladneInfo,
            'nazov_izieb' => Konfiguracia::vratZoznam(KonfiguraciaKategorie::KAT_NAZOV_IZBA),
            'nabytok'   => Konfiguracia::vratZoznam(KonfiguraciaKategorie::KAT_NABYTOK),
            'stena' => Konfiguracia::vratZoznam(KonfiguraciaKategorie::KAT_STENA),
            'osvetlenie' => Konfiguracia::vratZoznam(KonfiguraciaKategorie::KAT_OSVETLENIE),
            'povrch_steny' => Konfiguracia::vratZoznam(KonfiguraciaKategorie::KAT_POVRCH_STENY)
        ]);
    }
}