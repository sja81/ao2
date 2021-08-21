<?php
namespace backend\controllers;

use yii\web\Controller;

class ConfigsController extends Controller
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
                'class' => 'backend\actions\configs\IndexAction'
            ],
        ];
    }

}
