<?php
namespace backend\controllers;

use common\models\users\UserDetails;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use common\models\Agent;

class ProfileController extends Controller
{
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
        if (is_null(Yii::$app->user->identity)) {
            return $this->redirect(Url::to(['/site/login']));
        }

        $userId = Yii::$app->user->getId();

        if (Yii::$app->request->isPost) {
            $toUpdate = Yii::$app->request->post('toupdate');
            $data = Yii::$app->request->post();

            $tr = Yii::$app->db->beginTransaction();
            try{
                switch($toUpdate) {
                    case 'profile':{
                            Yii::$app->user->identity->updateProfileData($data);
                            Yii::$app->user->identity->save();
                            // update agent data -- need to be changed -- merge everything into user
                            $agent = Agent::findOne(['user_id'=>$userId]);
                            if ($agent) {
                                if ($agent->name_first != trim($data['name_first'])) {
                                    $agent->name_first = $data['name_first'];
                                }
                                if ($agent->name_last != trim($data['name_last'])) {
                                    $agent->name_last = $data['name_last'];
                                }
                                if ($agent->phone != trim($data['phone'])) {
                                    $agent->phone = $data['phone'];
                                }
                                $agent->save();
                                unset($agent);
                            }
                            // update user details
                            $details = UserDetails::findOne(['userId'=>$userId]);
                            if (!$details) {
                                $details = new UserDetails();
                                $details->userId = $userId;
                            }
                            $socialNetworks = [
                                'facebook', 'twitter', 'linkedin', 'instagram', 'youtube'
                            ];
                            foreach($socialNetworks as $network) {
                                if ($details->$network != trim($data[$network])) {
                                    $details->$network = $data[$network];
                                }
                            }
                            $details->save();
                            unset($details);
                            Yii::$app->session->setFlash('success', Yii::t('app','Údaje na profile boli úspešne zmenené!'));
                            unset($_POST);
                        }
                        break;
                    case 'password': {
                            Yii::$app->user->identity->setPassword($data['password']);
                            Yii::$app->user->identity->save();
                            Yii::$app->session->setFlash('success', Yii::t('app','Heslo bolo úspešne zmenené!'));
                        }
                        break;
                    case 'pic': {
                            $targetDir = Yii::getAlias('@webroot') . "/../../media/profiles/{$userId}";
                            if (!file_exists($targetDir)) {
                                mkdir($targetDir);
                            }
                            move_uploaded_file($_FILES['profilePic']['tmp_name'],$targetDir.'/'.$_FILES['profilePic']['name']);
                            $detail = UserDetails::findOne(['userId'=>$userId]);
                            if (!$detail) {
                                $detail = new UserDetails();
                                $detail->userId = $userId;
                            }
                            $detail->profilePic = $_FILES['profilePic']['name'];
                            $detail->save();
                            unset($detail);
                            Yii::$app->session->setFlash('success', Yii::t('app','Fotka bola úspešne zmenená!'));
                        }
                        break;

                }
                $tr->commit();
                return $this->redirect(Url::to(['/profile']));
            } catch(\Exception $e) {
                Yii::$app->session->setFlash('error',$e->getMessage());
                $tr->rollBack();
            }
        }

        return $this->render('index',[
            'userId'    => $userId,
            'user'  =>  Yii::$app->user,
            'agent' =>  Agent::findOne(['user_id'=>$userId]),
            'userDetails'   =>  UserDetails::findOne(['userId'=>$userId])
        ]);
    }
}