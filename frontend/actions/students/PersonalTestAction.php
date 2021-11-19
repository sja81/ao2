<?php
namespace frontend\actions\students;

use common\models\schools\StudentTests;
use yii\base\Action;
use Yii;

class PersonalTestAction extends Action
{
    public function run()
    {
        if (Yii::$app->request->isPost) {
            $tr = Yii::$app->db->beginTransaction();
            try{
                $studentId = Yii::$app->request->post('studentId');
                $results = Yii::$app->request->post('result');
                $test = new StudentTests();
                $test->studentId = $studentId;
                $test->testType = StudentTests::TESTTYPE_PERSONAL;
                $test->data = $results;
                $test->save();
                $tr->commit();

                $this->controller->redirect('/students/write-test/'.$studentId);
            } catch( \Exception $e) {
                $tr->rollBack();
            }

        }
        return $this->controller->render('tests/personal');
    }
}