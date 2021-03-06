<?php
namespace backend\controllers;

use common\helpers\TimeHelper;
use common\models\Agent;
use common\models\auth\AuthAssignment;
use common\models\auth\AuthItem;
use common\models\PrivilegesTemplates;
use common\models\schools\Students;
use common\models\users\UserAttendance;
use common\models\users\UserFile;
use yii\helpers\Html;
use yii\web\Controller;
use Yii;
use yii\helpers\Url;
use yii\web\Response;
use common\models\User;

class UserAttendanceAdminController extends Controller
{
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
     * @return \string[][]
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * @return string
     * @throws \yii\db\Exception
     */
    public function actionIndex(): string
    {
        return $this->render('index',[
            'title' => Yii::t('app','Dochádzka - administrácia'),
            'list' => (new UserAttendance())->getListForAdmin(),
            'groups' => AuthItem::find()->asArray()->all(),
            'modal_users' => $this->getUserList()
        ]);
    }

    /**
     * @return array
     * @throws \yii\db\Exception
     */
    private function getUserList(): array
    {
        $sql = "
        SELECT 
	        u.id,
	        CONCAT(IFNULL((SELECT CONCAT(name_first,' ',name_last) FROM agent WHERE user_id=u.id LIMIT 1),
	            '*** NONAME ***'), ' (', aa.item_name,')') AS meno
        FROM 
            auth_assignment aa
        JOIN
            user u ON u.id=aa.user_id
        WHERE
	        u.`status` = " . User::STATUS_ACTIVE;

        return Yii::$app->db->createCommand($sql)->queryAll();
    }

    /**
     * @param int $rid
     * @return void
     */
    public function actionEdit(int $rid)
    {
        $item = UserAttendance::find()->where(['id'=>$rid])->asArray()->one();
        $item['diffTime'] = TimeHelper::secToTime($item['diffTime']);
        $agent = Agent::findOne(['user_id'=>$item['userId']]);
        $item['meno'] = implode(" ",[$agent->name_first,$agent->name_last]);
        $item['user_group'] = (new AuthAssignment())->getGroupsByUserId($item['userId']);
        unset($agent);
        return $this->render('edit', [
            'title' => Yii::t('app','Dochádzka - editácia'),
            'item' => $item,
            'files' => UserFile::find()
                ->andWhere(['=','user_id',$item['userId']])
                ->andWhere(['like','created_at',$item['uaDate'].'%'])
                ->asArray()
                ->all()
        ]);
    }

    /**
     * @return string[]
     * @throws \yii\db\Exception
     */
    public function actionListUsers()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $result = ['status'=>'ok'];
        $group = Yii::$app->request->post('group');
        $startDate = Yii::$app->request->post('sdate');
        $endDate = Yii::$app->request->post('edate');
        $list = (new UserAttendance())->getListForAdminByOptions($group,$startDate,$endDate);
        $result['tbody'] = $this->renderPartial('tablebody',['list' => $list]);
        return $result;
    }

    /**
     * @return string[]
     */
    public function actionUpdateAttendance()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $data = Yii::$app->request->post();
        $item = UserAttendance::findOne(['id'=>$data['uaid']]);
        $result = ['status'=>'ok'];

        if (!$item) {
            $result = [
                'status' => 'error',
                'message' => Yii::t('app','Dochádzka nebola nájdená pre dátum ' . $data['uadate'])
            ];
        } else {
            try{
                $item->uaDate = $data['uadate'];
                $item->note = $this->sanitizeString($data['uanote']);
                $item->uaType = (int)$data['uatype'];
                $item->inTime = $data['intime'];
                $item->outTime = $data['outtime'];
                $item->inIP = $data['inip'];
                $item->outIP = $data['outip'];
                $item->save();

                $sql = "update userAttendance set diffTime=TIME_TO_SEC(TIMEDIFF(outTime,inTime)) where id={$item->id}";
                Yii::$app->db->createCommand($sql)->execute();

            } catch(\Exception $e) {
                $result = [
                    'status' => 'error',
                    'message' => $e->getTraceAsString()
                ];
            }
        }
        return $result;
    }

    /**
     * @return array|string[]
     */
    public function actionSaveAttendance()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $data = Yii::$app->request->post();

        $item = UserAttendance::findOne(['uaDate'=>$data['uadate'],'userId'=>$data['uid']]);
        $result = ['status'=>'ok'];

        if (!$item) {
            try{
                $item = new UserAttendance();
                $item->userId = $data['uid'];
                $item->uaDate = $data['uadate'];
                $item->uaType = $data['uatype'];
                $item->inTime = $data['intime'];
                $item->outTime = $data['outtime'];
                $item->note = $this->sanitizeString($data['uanote']);
                $item->uaAction = 1;
                $item->save();

                $sql = "update userAttendance set diffTime=TIME_TO_SEC(TIMEDIFF(outTime,inTime)) where id={$item->id}";
                Yii::$app->db->createCommand($sql)->execute();

                $list = (new UserAttendance())->getListForAdmin();
                $result['tbody'] = $this->renderPartial('tablebody',['list'=>$list]);
            } catch (\Exception $e) {
                $result = [
                    'status' => 'error',
                    'message' => $e->getTraceAsString()
                ];
            }
        } else {
            $result = [
                'status' => 'error',
                'message' => Yii::t('app',"Záznam na dátum {$data['uadate']} už existuje")
            ];
        }

        return $result;
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

    public function actionDocuments()
    {
        return $this->render('documents', [
            'privileges' => PrivilegesTemplates::find()->where(['=', 'user_function', 0])->all(),
            'students' => Students::find()->all()
        ]);
    }
}