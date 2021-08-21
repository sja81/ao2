<?php
namespace frontend\controllers;

use yii\web\Controller;

class PlannerController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'index' => [
                'class' => 'frontend\actions\planner\IndexAction'
            ]
        ];
    }
}