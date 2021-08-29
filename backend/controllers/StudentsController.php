<?php

namespace backend\controllers;

use yii\web\Controller;

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
            ]
        ];
    }
}