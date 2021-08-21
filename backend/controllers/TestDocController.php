<?php
namespace backend\controllers;

use common\models\documentsx\Documents;
use yii\web\Controller;


class TestDocController extends Controller
{

    public function actionProba(int $id)
    {
        $doc = new Documents();
        $doc
            ->setId($id)
            ->setPreview(true);
    }



}