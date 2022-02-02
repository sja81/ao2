<?php

namespace backend\controllers;

use yii\helpers\Url;
use yii\helpers\VarDumper;
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

    public function beforeAction($action)
    {
        if (is_null(Yii::$app->user->identity)) {
            $this->redirect(Url::to(['/site/login']));
            return false;
        }
        return parent::beforeAction($action);
    }

    public function actionIndex(?int $uid = null)
    {
        if(!empty($uid)) {
            $sql = "
                select
                    ua.id, ua.cTime, ua.status, concat(a.name_first,' ',a.name_last) as meno
                from
                    userAttendance ua
                join
                    agent a on a.user_id=ua.userId
                where
                    ua.userId=:uid
            ";
            $attendance = Yii::$app->db->createCommand($sql)->bindParam(':uid',$uid)->queryAll();
        } else {
            $sql = "
                select
                    ua.id, ua.cTime, ua.status, concat(a.name_first,' ',a.name_last) as meno
                from
                    userAttendance ua
                join
                    agent a on a.user_id=ua.userId";
            $attendance = Yii::$app->db->createCommand($sql)->queryAll();
        }
        return $this->render('index', [
            "attendance" => $attendance ?? [],
            "userId" => $uid ?? Yii::$app->user->identity->getId(),
            "pageTitle" =>  empty($uid) ? Yii::t('app','Dochádzka') : Yii::t('app','Moja dochádzka')
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
