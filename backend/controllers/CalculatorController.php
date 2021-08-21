<?php
namespace backend\controllers;

use yii\web\Controller;

class CalculatorController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'index' => [
                'class' => 'backend\actions\calculator\IndexAction'
            ]
        ];
    }

}