<?php

namespace backend\controllers;

use common\models\User;
use common\models\users\UserFile;
use yii\helpers\Url;
use yii\helpers\Html;
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

    /**
     * @param $action
     * @return bool
     * @throws \yii\web\BadRequestHttpException
     */
    public function beforeAction($action)
    {
        if (is_null(Yii::$app->user->identity)) {
            $this->redirect(Url::to(['/site/login']));
            return false;
        }
        return parent::beforeAction($action);
    }

    /**
     * @param int $rid
     * @return string
     */
    public function actionEdit(int $rid)
    {
        return $this->render('edit',[]);
    }

    /**
     * @param int $uid
     * @return string
     * @throws \yii\db\Exception
     */
    public function actionIndex(int $uid)
    {
        $attendance = new UserAttendance();
        return $this->render('index', [
            "attendance" => $attendance->getListByUserId($uid) ?? [] ,
            "userId" => $uid ?? Yii::$app->user->identity->getId(),
            "pageTitle" =>  empty($uid) ? Yii::t('app','Dochádzka') : Yii::t('app','Moja dochádzka'),
            "yearlySummary" => $attendance->getYearlyWorkedHoursByUserId($uid,true),
            "monthlySummary" => $attendance->getMonthlyWorkedHoursByUserId($uid, true),
            "dailySummary" => $attendance->getDailyWorkedHoursByUserId($uid, true),
            'isPresent' => Yii::$app->user->identity->isPresent((new \DateTime('now'))->format('Y-m-d')),
        ]);
    }

    /**
     * @return string[]
     */
    public function actionSaveComment(): array
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $userId = (int)Yii::$app->request->post('userId');
        $note = Yii::$app->request->post('note');
        $date = (new \DateTime('now'));
        $user = UserAttendance::findOne([
            'userId' => $userId,
            'uaDate' => $date->format('Y-m-d'),
        ]);
        if ($user instanceof UserAttendance) {
            $user->note .= nl2br($note);
            $user->save();
        }
        $rows = (new UserAttendance())->getListByUserId($userId);
        return [
            'status' => 'ok',
            'table_response'=> $this->renderPartial('tablebody',['rows'=>$rows]),
        ];
    }

    /**
     * @return array
     */
    public function actionArrival(): array
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $date = (new \DateTime('now'));

        $userId = Yii::$app->request->post('userId');
        $note = $this->sanitizeString(Yii::$app->request->post('note'));

        $arrivalTime = UserAttendance::find()->andWhere(['=','userId',$userId])->andWhere(['=','uaDate',$date->format('Y-m-d')])->one();
        if (!$arrivalTime) {
            $arrivalTime = new UserAttendance();
            $arrivalTime->userId = $userId;
            $arrivalTime->uaDate = $date->format('Y-m-d');
            $arrivalTime->inTime = $date->format('H:i:s');
            $arrivalTime->inIP = Yii::$app->request->getUserIP();
            $arrivalTime->uaType = UserAttendance::REGULAR_WORKTIME;
            $arrivalTime->note = $note ?? '';
            $arrivalTime->uaAction = 1;
            $arrivalTime->save();
        }
        $tableRows = $this->renderPartial('tablebody', [
            "rows" => $arrivalTime->getListByUserId($userId)
        ]);

        return [
            'status' => 'ok',
            'rows' => $tableRows
        ];
    }

    /**
     * @return array
     * @throws \yii\db\Exception
     */
    public function actionDeparture(): array
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $userId = Yii::$app->request->post('userId');
        $note = $this->sanitizeString(Yii::$app->request->post('note'));
        $date = (new \DateTime('now'));

        $departure = UserAttendance::find()
            ->andWhere(['=','uaDate',$date->format('Y-m-d')])
            ->andWhere(['=','userId',$userId])
            ->one();
        if (!$departure) {
            $departure = new UserAttendance();
            $departure->userId = $userId;
            $departure->uaType = UserAttendance::REGULAR_WORKTIME;
        }
        $departure->outTime = $date->format('H:i:s');
        $departure->note .= $note;
        $departure->outIP = Yii::$app->request->getUserIP();

        $departure->save();

        if (!is_null($departure->inTime)) {
            $sql = "update userAttendance set diffTime=TIME_TO_SEC(TIMEDIFF(outTime,inTime)) where id={$departure->id}";
            Yii::$app->db->createCommand($sql)->execute();
        }

        $tableRows = $this->renderPartial('tablebody', [
            "rows" => $departure->getListByUserId($userId)
        ]);

        return [
            'status' => 'ok',
            'rows' => $tableRows,
            'day_total_time' => $departure->getDailyWorkedHoursByUserId($userId, true),
            'month_total_time' => $departure->getMonthlyWorkedHoursByUserId($userId, true),
            'year_total_time'   => $departure->getYearlyWorkedHoursByUserId($userId, true)
        ];
    }

    /**
     * @param string|null $str
     * @return string
     */
    private function sanitizeString(?string $str = null): string
    {
        $result = '';
        if (!is_null($str)) {
            $result = Html::encode(trim($str));
        }
        return $result;
    }

    /**
     * @return string[]
     */
    public function actionSavePhotos()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $result = ['status' => 'ok'];
        $uid = Yii::$app->request->post('uid');
        $dirName = Yii::getAlias('@backend')."/users/{$uid}";
        if (!file_exists($dirName)) {
            mkdir($dirName);
        }
        // first save to DB!
        $tr = Yii::$app->db->beginTransaction();
        try {

            $file = new UserFile();
            $file->user_id = $uid;
            $file->file = $_FILES['photo']['name'];
            $file->save();

            $tr->commit();

            move_uploaded_file($_FILES['photo']['tmp_name'],"{$dirName}/".$_FILES['photo']['name']);

        } catch(\Exception $e) {
            $tr->rollBack();
            $result = [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
        }
        return $result;
    }
}
