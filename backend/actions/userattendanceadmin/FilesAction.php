<?php
namespace backend\actions\userattendanceadmin;

use Yii;
use yii\base\Action;
use common\models\users\UserAttendance;

class FilesAction extends Action
{
    public function run()
    {
        if (is_null(Yii::$app->user->identity)) {
            return $this->controller->redirect(Url::to(['/site/login']));
        }
        return $this->controller->render("files");
    }
}