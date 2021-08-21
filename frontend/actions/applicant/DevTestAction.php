<?php
namespace frontend\actions\applicant;

use Yii;
use yii\base\Action;
use yii\helpers\Url;
use common\models\uchadzac\UchadzacTest;

class DevTestAction extends Action
{
    public function run()
    {
        if (\Yii::$app->request->isPost) {
            $applicantId = Yii::$app->request->post('applicant_id');
            $quiz = Yii::$app->request->post('Quiz');

            $applicant = UchadzacTest::findOne(['uchadzac_id'=>$applicantId]);
            if (!$applicant) {
                $applicant = new UchadzacTest();
                $applicant->uchadzac_id=$applicantId;
            }
            $applicant->developer_test = json_encode($quiz);
            $applicant->save();
            $this->controller->redirect(Url::to(['/applicant/thank-you']));
        }
        $this->controller->layout = 'applicant';
        return $this->controller->render('dev-test/index');
    }
}