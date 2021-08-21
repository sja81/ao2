<?php
namespace backend\actions\contracts;

use common\models\Nehnutelnost;
use common\models\Zmluva;
use common\models\ZmluvaNehnutelnost;
use Yii;
use yii\base\Action;
use yii\helpers\Url;

class DocumentsAction extends Action
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

        $zmluva = Zmluva::findOne(['id'=>$id]);
        $nehnutelnostId = (ZmluvaNehnutelnost::findOne(['zmluva_id'=>$id]))->nehnut_id;
        $nehnutelnost = Nehnutelnost::findOne(['id',$nehnutelnostId]);

        return $this->controller->render('new/documents',[
            'contract'          => $zmluva,
            'kategoria'         => $nehnutelnost->kategoria,
            'pocet_zakaznikov'  => $zmluva->pocetZakaznikov()
        ]);
    }
}