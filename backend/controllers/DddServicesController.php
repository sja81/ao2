<?php
namespace backend\controllers;

use yii\web\Controller;

class DddServicesController extends Controller
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
            'settings' => [
                'class' => 'backend\actions\dddservices\settings\IndexAction'
            ],
            'orders' => [
                'class' => 'backend\actions\dddservices\orders\IndexAction'
            ]
        ];
    }
}