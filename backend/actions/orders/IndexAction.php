<?php
namespace backend\actions\orders;

class IndexAction extends \yii\base\Action
{
    public function run()
    {
        if (is_null(\Yii::$app->user->identity)) {
            return $this->controller->redirect(yii\helpers\Url::to(['/site/login']));
        }

        return $this->controller->render('index');
    }
}