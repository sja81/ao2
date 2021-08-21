<?php
namespace backend\controllers;

use yii\web\Controller;

class CustomersController extends Controller
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
                'class' => 'backend\actions\customers\IndexAction'
            ],
            'search' => [
                'class' => 'backend\actions\customers\SearchAction'
            ],
            'open'  => [
                'class' => 'backend\actions\customers\OpenAction'
            ]
        ];
    }

}
