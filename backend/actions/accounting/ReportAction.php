<?php

namespace backend\actions\accounting;

use yii\base\Action;
use yii\helpers\Url;
use Yii;

class ReportAction extends Action
{
    public function run()
    {
        if (is_null(Yii::$app->user->identity)) {
            return $this->controller->redirect(Url::to(['/site/login']));
        }

        return $this->controller->render('report/index',[]);
    }
}