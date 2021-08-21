<?php
namespace backend\actions\cms;

use Yii;
use yii\base\Action;
use yii\helpers\Url;

class CounterAction extends Action
{
    public function run()
    {
        if (is_null(Yii::$app->user->identity)) {
            return $this->controller->redirect(Url::to(['/site/login']));
        }

        return $this->controller->render('counter/index', [
        ]);
    }
}