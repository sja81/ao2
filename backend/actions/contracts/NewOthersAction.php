<?php
namespace backend\actions\contracts;

use common\models\Konfiguracia;
use common\models\KonfiguraciaKategorie;
use Yii;
use yii\base\Action;
use yii\helpers\Url;
use common\models\Ucel;


class NewOthersAction extends Action
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

        return $this->controller->render('new/others',[
            'contract_type' => Ucel::getVsetkyUcely(),
            'prenajom_podmienky' => Konfiguracia::vratZoznam(KonfiguraciaKategorie::KAT_PODMIENKY,'prenajom'),
            'predaj_podmienky' => Konfiguracia::vratZoznam(KonfiguraciaKategorie::KAT_PODMIENKY, 'predaj'),
            'socialne_siete'    => Konfiguracia::vratZoznam(KonfiguraciaKategorie::KAT_SOC_SIETE),
            'prenajom_provizia' => Yii::$app->db->createCommand("select * from provizia_prenajom where status=1")->queryOne(),
            'predaj_provizia' => Yii::$app->db->createCommand("select cena_od, cena_do, provizia, min_provizia from provizia_predaj where status=1")->queryAll()
        ]);
    }
}