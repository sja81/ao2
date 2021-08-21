<?php
namespace backend\actions\contracts;

use Yii;
use yii\base\Action;
use yii\helpers\Url;

class ObhliadkyAction extends Action
{
    public function run(int $id)
    {
        if (is_null(Yii::$app->user->identity)) {
            return $this->controller->redirect(Url::to(['/site/login']));
        }

        return $this->controller->render('obhliadky/index',[

            ]
        );
    }

}