<?php

namespace frontend\actions\students;
use common\models\schools\StudentTests;
use Yii;
use yii\base\Action;
use yii\helpers\Url;

class DevTestAction extends Action
{
    public function run()
    {
        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post('Quiz');
            $studentId = Yii::$app->request->post('studentId');
            $test = new StudentTests();
            $test->studentId = $studentId;
            $test->testType = StudentTests::TESTTYPE_DEV;
            $test->data = json_encode($data);
            $test->save();

            $this->controller->redirect(Url::to(['/students/test-thank-you/'.$studentId]));
        }
        return $this->controller->render('tests/dev-test');
    }
}