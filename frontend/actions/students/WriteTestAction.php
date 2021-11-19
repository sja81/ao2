<?php
namespace frontend\actions\students;

use common\models\schools\StudentTests;
use Yii;
use yii\base\Action;

class WriteTestAction extends Action
{
    public function run()
    {
        if (Yii::$app->request->isPost) {
            $studentId = Yii::$app->request->post('studentId');
            $data = Yii::$app->request->post('writting_test');
            $tr = Yii::$app->db->beginTransaction();
            try {
                $test = new StudentTests();
                $test->studentId = $studentId;
                $test->testType = StudentTests::TESTTYPE_WRITE;
                $test->data = $data;
                $test->save();

                $tr->commit();
                $this->controller->redirect("/students/video-test/{$studentId}");
            } catch (\Exception $e) {
                $tr->rollBack();
            }
        }
        return $this->controller->render('tests/writing-test');
    }
}