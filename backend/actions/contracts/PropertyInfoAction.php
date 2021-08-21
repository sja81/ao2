<?php
namespace backend\actions\contracts;

use common\models\Nehnutelnost;
use common\models\NehnutelnostLv;
use common\models\Zmluva;
use common\models\ZmluvaNehnutelnost;
use Yii;
use yii\base\Action;
use yii\helpers\Url;

class PropertyInfoAction extends Action
{
    protected function run()
    {
        if (is_null(Yii::$app->user->identity)) {
            return $this->controller->redirect(Url::to(['/site/login']));
        }

        $zmluva = null;
        $cislo = null;
        $cislo_byt = -1;

        if (!Yii::$app->request->cookies->getValue('zmluva-cislo')) {
            return $this->controller->redirect(Url::to(['/']));
        } else {
            $cislo = Yii::$app->request->cookies->getValue('zmluva-cislo');
            $zmluva = Zmluva::findOne(['cislo'=>$cislo]);
            $cislo_byt = Yii::$app->request->cookies->getValue('cislo_bytu');
            $nehnutId = ZmluvaNehnutelnost::find()->select(['nehnut_id'])->where(['=','zmluva_id',$zmluva->id])->one();
            $nehnutelnost = Nehnutelnost::findOne(['id'=>$nehnutId]);
        }

        return $this->controller->render('new/property-info',[
            'contract_number'   => $cislo,
            'zmluva_id' => $zmluva->id,
            'lv_data' => NehnutelnostLv::loadLvData($cislo),
            'cislo_byt'   => $cislo_byt,
            'byt'   => NehnutelnostLv::getByt($cislo, $cislo_byt),
            'nehnutelnost' => $nehnutelnost
        ]);

    }
}