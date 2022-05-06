<?php

namespace backend\controllers;

use common\models\client\Client;
use yii\helpers\Url;
use Yii;
use yii\web\Controller;

class ClientsController extends Controller
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
                'class' => 'backend\actions\clients\IndexAction'
            ],
        ];
    }

    public function actionEdit(int $id)
    {

        $client = Client::findOne($id);
        $clientContact = $client->clientContact;

        if(Yii::$app->request->isPost){
            $clientInfo = Yii::$app->request->post('Client');
            $clientContactInfo = Yii::$app->request->post('ClientContact');

            foreach($clientInfo as $key => $value) {
                $client->$key = $value;
            }
            $client->save();

            foreach($clientContactInfo as $key =>$value) 
            {
                $clientContact->$key = $value;
            }
            $clientContact->save();

            return $this->redirect(Url::to(['/clients']));
        }

        return $this->render('edit', [
            'client' => $client,
            'clientContact' => $clientContact
        ]);
    }
}
