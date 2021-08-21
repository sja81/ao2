<?php
namespace backend\actions\applicant;

use common\models\Applications;
use common\models\uchadzac\Uchadzac;
use Yii;
use yii\base\Action;
use yii\helpers\Url;

class IndexAction extends Action
{
    public function run()
    {
        if (is_null(Yii::$app->user->identity)) {
            return $this->controller->redirect(Url::to(['/site/login']));
        }

        return $this->controller->render('index',
            [
                'applicants'    => Uchadzac::find()->with('pozicia')->all(),
                'jobs'          => Applications::find()->where(['=','visible',1])->asArray()->all()
            ]
        );
    }
}