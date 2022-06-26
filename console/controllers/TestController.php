<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;

class TestController extends Controller
{
    // private function myTest($id, ...$items)
    // {
    //     var_dump($items);
    // }

    // public function actionIndex()
    // {
    //     $this->myTest(1, 'elso', 'masodik', 'harmadik', 12, [1,2,3]);
    // }

    public function actionIndex()
    {
        $password = "";
        echo Yii::$app->security->generatePasswordHash($password);
    }
}
