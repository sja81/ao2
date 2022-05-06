<?php
namespace frontend\controllers;

use yii\web\Controller;

class CustomerController extends Controller
{
    /**
     * @return array
     */
    public function actions(): array
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'index' => [
                'class' =>  'frontend\actions\cuba\IndexAction'
            ],
            'registration' => [
                'class' => 'frontend\actions\cuba\RegistrationAction'
            ],
            'save-it' => [
                'class' => 'frontend\actions\cuba\SaveCustomerAction'
            ]
        ];
    }
}