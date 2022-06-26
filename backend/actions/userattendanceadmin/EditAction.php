<?php
namespace backend\actions\userattendanceadmin;

use Yii;
use yii\base\Action;
use common\models\users\UserAttendance;

class EditAction extends Action
{
    public function run()
    {
        if (is_null(Yii::$app->user->identity)) {
            return $this->controller->redirect(Url::to(['/site/login']));
        }

        $id = Yii::$app->request->get('id');
        $rows = UserAttendance::find()->where(["=","userId",$id])->all();
        return $this->controller->render("edit",[
            "attendanceList" => $rows
        ]);
    }
}