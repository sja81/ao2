<?php

namespace backend\controllers;

use yii\web\Controller;
use common\models\users\UserAttendance;
use Yii;
use yii\web\Response;

class UserAttendanceController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',

            ]
        ];
    }

    public function actionIndex()
    {
        return $this->render('index', [
            "attendance" => UserAttendance::find()->all(),
            "userId" => Yii::$app->user->identity->getId()
        ]);
    }

    public function actionArrival()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $userId = Yii::$app->request->post('userId');
        $arrivalTime = new UserAttendance();
        $arrivalTime->userId = $userId;
        $arrivalTime->cTime = (new \DateTime('now'))->format('Y-m-d H:i:s');
        $arrivalTime->status = UserAttendance::PRICHOD;
        $arrivalTime->save();
        unset($arrivalTime);

        $rows = UserAttendance::find()->all();
        $tableRows = $this->renderPartial('tablebody', [
            "rows" => $rows
        ]);

        return [
            'status' => 'ok',
            'rows' => $tableRows
        ];
    }

    public function actionDeparture()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $userId = Yii::$app->request->post('userId');
        $departureTime = new UserAttendance();
        $departureTime->userId = $userId;
        $departureTime->cTime = (new \DateTime('now'))->format('Y-m-d H:i:s');
        $departureTime->status = UserAttendance::ODCHOD;
        $departureTime->save();
        unset($departureTime);

        $rows = UserAttendance::find()->all();
        $tableRows = $this->renderPartial('tablebody', [
            "rows" => $rows
        ]);

        return [
            'status' => 'ok',
            'rows' => $tableRows
        ];
    }
}
