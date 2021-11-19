<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;

class StudentsController extends Controller
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
                'class' => 'backend\actions\students\IndexAction'
            ],
            'reports' => [
                'class' => 'backend\actions\students\ReportsAction'
            ]
        ];
    }

    public function actionUpdateIban()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        var_dump(Yii::$app->request->post());exit;

        return ['status'=>'ok'];
    }
}