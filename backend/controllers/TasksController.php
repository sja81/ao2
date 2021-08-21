<?php
namespace backend\controllers;

use yii\web\Controller;

class TasksController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'index' => [
                'class' => 'backend\actions\tasks\IndexAction'
            ]
        ];
    }
}