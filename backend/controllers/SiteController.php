<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\users\UsersStats;
use common\models\CalendarEventType;
/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['get', 'post'],
                ],
            ],
        ];
    }

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
                'class' => 'backend\actions\sites\IndexAction'
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $calEvent = new CalendarEventType();
        if(Yii::$app->request->isPost){
            var_dump(Yii::$app->request->post());
            exit;
            $calEvent->load(Yii::$app->request->post());
            $calEvent->save();
        }   
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        $this->layout = 'login';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {

            $this->userStats(UsersStats::ACTION_LOGIN);

            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }
    private function userStats(string $action): void
    {

        $stats = new UsersStats();
        $stats->userAction = $action;
        $stats->userId = Yii::$app->user->getId();
        $stats->userIp = Yii::$app->getRequest()->getUserIP();
        $stats->save();
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {

        $this->userStats(UsersStats::ACTION_LOGOUT);
        Yii::$app->user->logout();

        return $this->goHome();
    }
}