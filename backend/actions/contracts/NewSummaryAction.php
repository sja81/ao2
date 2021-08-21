<?php
namespace backend\actions\contracts;

use common\models\WordCollection;
use Yii;
use yii\base\Action;
use yii\helpers\Url;


class NewSummaryAction extends Action
{
    public function run(int $id)
    {
        /*if (is_null(Yii::$app->user->identity)) {
            return $this->controller->redirect(Url::to(['/site/login']));
        }*/

        $cislo = null;
        $cislo_byt = -1;

        if (!Yii::$app->request->cookies->getValue('zmluva-cislo')) {
            return $this->controller->redirect(Url::to(['/']));
        } else {
            $cislo = Yii::$app->request->cookies->getValue('zmluva-cislo');
            $cislo_byt = Yii::$app->request->cookies->getValue('cislo_bytu');
        }

        $wc = new WordCollection();

        return $this->controller->render("new/summary",[
            'prime_text'    => $wc->getPrimaryText(1),
            'texts'         => $wc->getTexts(1)
        ]);
    }
}