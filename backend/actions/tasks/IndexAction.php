<?php
namespace backend\actions\tasks;

use Yii;
use yii\base\Action;
use yii\helpers\Url;
use common\models\tasks\Tasks;

class IndexAction extends Action
{
    public function run()
    {
        if (is_null(Yii::$app->user->identity)) {
            return $this->controller->redirect(Url::to(['/site/login']));
        }

        return $this->controller->render('index',[
            'comments'  =>  Tasks::find()->all()
        ]);
    }
}