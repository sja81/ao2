<?php
namespace backend\actions\contracts;

use common\models\Konfiguracia;
use common\models\KonfiguraciaKategorie;
use common\models\Kraj;
use common\models\NehnutelnostDruhy;
use common\models\Okres;
use common\models\search\BackendSearch;
use common\models\Stat;
use common\models\Ucel;
use Yii;
use yii\base\Action;
use common\models\Zmluva;
use yii\helpers\Url;

class IndexAction extends Action
{
    public function run()
    {
        if (is_null(Yii::$app->user->identity)) {
            return $this->controller->redirect(Url::to(['/site/login']));
        }

        $this->cleanCookies();
        $zmluvy = [];
        $pocetZmluv = 0;
        $vyhladavanie = 0;
        $page = 1;

        if (isset($_GET['p']) && (int)($_GET['p'])>0) {
            $page = (int)($_GET['p']);
        }

        if (Yii::$app->request->get('Search')) {
            $result = Yii::$app->request->get('Search');
            $search = new BackendSearch();
            $search->nastavParametre($result);
            $zmluvy = $search->zoznamZmluv(null,BackendSearch::PAGE_LIMIT,($page - 1)*BackendSearch::PAGE_LIMIT);
            $pocetZmluv = $search->pocetZmluv();
            $vyhladavanie=1;
            unset($search);
        } else {
            $zmluva = new Zmluva();
            $zmluvy = $zmluva->zoznamZmluv(null,BackendSearch::PAGE_LIMIT,($page - 1)*BackendSearch::PAGE_LIMIT);
            $pocetZmluv = $zmluva->pocetZmluv();
            unset($zmluva);
        }

        return $this->controller->render('index',[
            'contracts'     => $zmluvy,
            'pocet_zmluv'   => $pocetZmluv,
            'akt_strana'    => $page,
            'typy'          => Ucel::getVsetkyUcely(),
            'staty'         => Stat::getStaty(),
            'stav'          => Konfiguracia::vratZoznam(KonfiguraciaKategorie::KAT_OBJ_STAV),
            'druhy'         => NehnutelnostDruhy::druhyDoVyhladavania(),
            'kraje'         => Kraj::krajePreVyhladanie(),
            'vyhladavanie'  => $vyhladavanie,
            'okresy'        => Okres::okresyPreVyhladanie()
        ]);
    }

    private function cleanCookies()
    {
        $cookies = Yii::$app->request->cookies;

        if ($cookies->get('zmluva-cislo') !== null) {
            Yii::$app->response->cookies->remove('zmluva-cislo');
        }
        if ($cookies->get('krok') !== null) {
            Yii::$app->response->cookies->remove('krok');
        }
    }
}