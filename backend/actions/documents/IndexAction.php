<?php
namespace backend\actions\documents;

use common\models\Template;
use common\models\TemplateCategory;
use yii\base\Action;
use yii\helpers\Url;
use Yii;

class IndexAction extends Action
{
    public function run()
    {
        if (is_null(Yii::$app->user->identity)) {
            return $this->controller->redirect(Url::to(['/site/login']));
        }

        return $this->controller->render('index',
            [
                'templates'           => Template::find()->all()
            ]
        );
    }
}