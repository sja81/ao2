<?php
namespace backend\controllers;

use yii\web\Controller;

class OrdersController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'index' => [
                'class' => 'backend\actions\orders\IndexAction'
            ],
            'add'   => [
                'class'   => 'backend\actions\orders\AddAction'
            ]
        ];
    }
}