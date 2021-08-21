<?php
namespace backend\controllers;

use common\models\Agent;
use common\models\Office;
use yii\web\Controller;
use yii\web\Response;
use Yii;

class OfficeAjaxController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionGetDetailsWithAgents()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $officeId = (int)Yii::$app->request->post('officeid');

        return [
            'result'    =>  'ok',
            'agents'    => Agent::findAll(['office_id'=>$officeId]),
            'details'   => Office::find()->andWhere(['=','id',$officeId])->one()
        ];
    }
}