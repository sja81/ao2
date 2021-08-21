<?php
namespace backend\actions\contracts;

use common\models\Operator;
use common\models\Stat;
use common\models\AcademicDegrees;
use common\models\NehnutelnostLv;
use common\models\Zmluva;
use Yii;
use yii\helpers\Url;
use yii\base\Action;
use yii\web\Cookie;

class NewMajiteliaAction extends Action
{
    public function run($id)
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

        $degrees = new AcademicDegrees();

        return $this->controller->render('new/majitelia',[
            'titul_pred'    => $degrees->getTitulPredMenom(),
            'titul_za'      => $degrees->getTitulZaMenom(),
            'cislo_byt'   => $cislo_byt,
            'byt'   => NehnutelnostLv::getByt($cislo, $cislo_byt),
			'predvolby' => Stat::getPredvolby(),
            'uto'       => Operator::getUTO(Stat::SLOVAKIA)
        ]);
    }
}