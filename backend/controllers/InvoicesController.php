<?php
namespace backend\controllers;

use common\models\accounting\invoice\Invoice;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class InvoicesController extends Controller
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Invoice::find(),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('index',[
           'dataProvider'  =>  $dataProvider
        ]);
    }
}