<?php
namespace backend\actions\users;

use common\models\Agent;
use common\models\Commissions;
use common\models\User;
use common\models\users\UserGroups;
use Yii;
use yii\db\Expression;
use yii\helpers\Url;
use yii\base\Action;
use common\models\Office;

class AddAction extends Action
{

    public function run()
    {
        if (is_null(Yii::$app->user->identity)) {
            return $this->controller->redirect(Url::to(['/site/login']));
        }

        if (Yii::$app->request->isPost) {
            $userData = Yii::$app->request->post('User');
            $tr = Yii::$app->db->beginTransaction();
            try{
                $userId = $this->saveUser($userData);
                foreach($userData['office_id'] as $item) {
                    $this->saveAgent($userData, $item,$userId);
                }
                $tr->commit();
                $this->controller->redirect(Url::to(['/users']));
            } catch(\Exception $e) {
                $tr->rollBack();
            }
        }

        return $this->controller->render('add',[
            'usergroups'    =>  $this->getAuthItems(),
            'commissions'   =>  $this->getCommissions(),
            'offices'       =>  $this->getOffices()
        ]);
    }

    private function saveUser($userData)
    {
        // save to user table
        $user = new User();
        $user->setPassword(trim($userData['password']));
        $user->username = trim($userData['username']);
        $user->email = trim($userData['email']);
        $user->status = User::STATUS_ACTIVE;
        $user->created_at = new Expression('NOW()');

        $user->save();

        Yii::$app
            ->db
            ->createCommand("INSERT INTO auth_assignment VALUES ('{$userData['auth_assignment']}', {$user->id}, NOW())")
            ->execute();
        return $user->id;
    }

    private function saveAgent($userData, $officeId, $userId)
    {
        // save to agent table
        $agent = new Agent();
        $agent->user_id = $userId;
        $agent->office_id = $officeId;
        $agent->phone = trim($userData['phone']);
        $agent->email = trim($userData['email']);
        if (isset($userData['commission'])) {
            $agent->commission = $userData['commission'];
        }
        $agent->name_first = trim($userData['name_first']);
        $agent->name_last = trim($userData['name_last']);
        $agent->save();
    }

    private function getOffices()
    {
        return Office::find()->where(['=','status',1])->asArray()->all();
    }

    private function getAuthItems()
    {
        return UserGroups::find()->asArray()->all();
    }

    private function getCommissions()
    {
        return Commissions::find()->where(['=','status',1])->asArray()->all();
    }
}