<?php
namespace backend\controllers;

use yii\web\Controller;

class ObhliadkaController extends Controller
{
    public function beforeAction($action)
    {

        return parent::beforeAction($action);
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'index' => [
                'class' => 'backend\actions\obhliadka\IndexAction'
            ]
        ];
    }
}