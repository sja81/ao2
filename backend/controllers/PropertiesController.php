<?php
namespace backend\controllers;

use yii\web\Controller;
use Yii;

class PropertiesController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {

    }

}