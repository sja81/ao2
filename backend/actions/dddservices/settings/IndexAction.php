<?php
namespace backend\actions\dddservices\settings;

use common\models\Material;
use common\models\OzoneSettings;
use common\models\Stock;
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
        return $this->controller->render('settings/index',[
            'ozone_settings'    => OzoneSettings::find()->asArray()->all(),
            'materials'         => Material::find()->all(),


        ]);
    }
}