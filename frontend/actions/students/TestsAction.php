<?php
namespace frontend\actions\students;

use Yii;
use yii\base\Action;
use common\models\schools\Students;

class TestsAction extends Action
{
    public function run()
    {
        $id = Yii::$app->request->get('id');
        $student = Students::findOne(['id'=>$id]);
        $error = false;

        if (!$student) {
            $error = true;
        }

        return $this->controller->render('tests/index',[
            'error'     =>  $error,
            'student'   =>  $student
        ]);
    }
}