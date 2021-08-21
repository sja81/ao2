<?php
namespace backend\controllers;

use common\models\uchadzac\Uchadzac;
use common\models\uchadzac\UchadzacTest;
use yii\web\Controller;
use yii\web\Response;

class ApplicantController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'index' => [
                'class' => 'backend\actions\applicant\IndexAction'
            ],
            'view' => [
                'class' => 'backend\actions\applicant\ViewAction'
            ]
        ];
    }

    public function actionAjaxCloseCase()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $result = [
            'status'    => 'ok'
        ];



        return $result;
    }

    public function actionAjaxUpdateDevTestTotal()
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $result = ['status'=>'ok'];
        ['application_id' => $applicationId, 'action' => $action] = \Yii::$app->request->post();
        $test = UchadzacTest::findOne(['uchadzac_id'=>$applicationId]);
        if (!$test) {
            return ['status'=>'error', 'message'=>'Uchadzac neexistuje'];
        }
        switch($action) {
            case 'add':
                ++$test->developer_test_total;
                break;
            case 'dec':
                --$test->developer_test_total;
                break;
            default:
                return ['status'=>'error', 'message'=>'Not supported action!!!'];
        }
        $res = $test->save();
        if (!$res) {
            return ['status' => 'error', 'message' => 'Error during the save!'];
        }
        $result['total'] = $test->developer_test_total;
        return $result;
    }
}