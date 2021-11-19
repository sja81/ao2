<?php

namespace frontend\controllers;

use common\models\idcardreader\SlovakIdCardProcessor;
use common\models\schools\StudentLegalRepresentative;
use common\models\schools\Students;
use common\models\schools\StudentTests;
use yii\web\Controller;
use Yii;
use yii\web\Response;

class StudentsController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'index' => [
                'class' =>  'frontend\actions\students\IndexAction'
            ],
            'ajax-api' => [
                'class' => 'frontend\actions\students\AjaxApiAction'
            ],
            'tests' =>  [
                'class' => 'frontend\actions\students\TestsAction'
            ],
            'personal-test' => [
                'class' =>  'frontend\actions\students\PersonalTestAction'
            ],
            'write-test'    => [
                'class' => 'frontend\actions\students\WriteTestAction'
            ],
            'video-test'    => [
                'class' =>  'frontend\actions\students\VideoTestAction'
            ],
            'test-thank-you'    =>  [
                'class' => 'frontend\actions\students\TestThankYouAction'
            ],
            'dev-test'  => [
                'class' =>  'frontend\actions\students\DevTestAction'
            ],
            'halova'    =>  [
                'class' =>  'frontend\actions\students\HalovaAction'
            ]
        ];
    }

    public function actionUploadCard()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        try{
            $ocr = new SlovakIdCardProcessor();
            $ocr->pridajPrednuStranu($_FILES['op-predna']['tmp_name']);
            $ocr->pridajZadnuStranu($_FILES['op-zadna']['tmp_name']);
            $result = $ocr->processDocument('Y-m-d');
        }catch(\Exception $ex) {
            return ['status'=>'error','message'=>$ex->getMessage()];
        }

        return ['status'=>'ok','items'=>$result];
    }

    private function createStudentDirectory(int $id, string $firstName, string $lastName, string &$directory): bool
    {
        $directory =Yii::getAlias('@webroot')."/../../media/students/";
        $student = Students::findOne(['id'=>$id]);
        if (!$student) {
            return false;
        }

        $studentDir[] = $id;
        $studentDir[] = str_replace(" ","-",$firstName);
        $studentDir[] = str_replace(" ","-",$lastName);
        $directory .= join("-",$studentDir);

        if (!file_exists($directory)) {
            mkdir($directory);
        }

        return true;
    }

    public function actionUploadVideo()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $id = Yii::$app->request->post('studentid');

        $targetDir =Yii::getAlias('@webroot')."/../../media/students/";

        $student = Students::findOne(['id'=>$id]);
        if (!$student) {
            return [
                'status'    => 'error',
                'message'   =>  'Student not found'
            ];
        }

        $studentDir[] = $id;
        $studentDir[] = str_replace(" ","-",$student->firstName);
        $studentDir[] = str_replace(" ","-",$student->lastName);
        $studentDir = join("-",$studentDir);

        if (!file_exists($targetDir.$studentDir)) {
            mkdir($targetDir.$studentDir);
        }
        $fileName = $targetDir.$studentDir."/record-".(new \DateTime('now'))->format('Y-m-d-H-i-s').".webm";
        move_uploaded_file($_FILES['data']['tmp_name'],$fileName);

        // save the video file name to DB
        $test = new StudentTests();
        $test->studentId = $id;
        $test->testType= StudentTests::TESTTYPE_VIDEO;
        $test->resultFile = $fileName;
        $test->save();

        return [
            'status'    => 'ok'
        ];
    }

    public function actionThankYou()
    {
        // send email to the student
        $sid = Yii::$app->request->get("id");
        $student = Students::findOne(['id'=>$sid]);
        $legalRep = StudentLegalRepresentative::findOne(['studentId'=>$sid]);

        Yii::$app
            ->mailer
            ->compose(['html' => 'studentRegistration-html'],['studentName'=>$student->getFullName(), 'id' => $sid])
            ->setFrom('info@aoreal.sk')
            ->setTo($student->email)
            ->setCc($legalRep->email)
            ->setBcc('szabo.balazs@aoreal.sk')
            ->setSubject('Úspešná registrácia')
            ->send();

        return $this->render('thank-you');
    }
}