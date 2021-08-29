<?php

namespace frontend\controllers;

use common\models\idcardreader\SlovakIdCardProcessor;
use common\models\schools\StudentLegalRepresentative;
use common\models\schools\Students;
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
            ]
        ];
    }

    public function actionUploadCard()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $result = "";
        try{
            $ocr = new SlovakIdCardProcessor();
            $ocr->pridajPrednuStranu($_FILES['op-predna']['tmp_name']);
            $ocr->pridajZadnuStranu($_FILES['op-zadna']['tmp_name']);
            $result = $ocr->processDocument('Y-m-d');
        }catch(\Exception $ex) {
            return ['status'=>'error','message'=>$ex->getMessage()];
        }

        // ulozit karty

        return ['status'=>'ok','items'=>$result];
    }

    public function actionThankYou()
    {
        // send email to the student
        $sid = Yii::$app->request->get("id");
        $student = Students::findOne(['id'=>$sid]);
        $legalRep = StudentLegalRepresentative::findOne(['studentId'=>$sid]);
        Yii::$app
            ->mailer
            ->compose(['text' => 'studentRegistration-text'])
            ->setFrom('info@aoreal.sk')
            ->setTo($student->email)
            ->setCc($legalRep->email)
            ->setBcc('szabo.balazs@aoreal.sk')
            ->setSubject('Úspešná registrácia')
            ->send();

        return $this->render('thank-you');
    }
}