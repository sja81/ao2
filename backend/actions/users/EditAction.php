<?php
namespace backend\actions\users;

use common\models\Commissions;
use common\models\Office;
use common\models\settings\Privileges;
use common\models\User;
use common\models\users\PrivilegesUsers;
use common\models\users\UserGroups;
use Yii;
use yii\base\Action;
use yii\helpers\Url;
use common\models\Agent;

class EditAction extends Action
{
    public function run()
    {
        if (is_null(Yii::$app->user->identity)) {
            return $this->controller->redirect(Url::to(['/site/login']));
        }

        $userId = (int)Yii::$app->request->get('uid');
        $user = User::findOne(['id'=>$userId]);

        if (Yii::$app->request->isPost) {
            $userData = Yii::$app->request->post('User');
            $tr = Yii::$app->db->beginTransaction();
            try {
                $this->saveUser($user, $userData);
                foreach($userData['office_id'] as $item) {
                    $this->saveAgent($userData, $item, $user->id);
                }
                $tr->commit();
            } catch (\Exception $e) {
                echo $e->getMessage();
                $tr->rollBack();
            }
            $this->controller->redirect(Url::to(['/users']));
        }

        return $this->controller->render('edit',[
            'usergroups'    =>  $this->getAuthItems(),
            'commissions'   =>  $this->getCommissions(),
            'user'          =>  $user,
            'agent'         =>  $this->getAgentData($userId),
            'offices'       =>  $this->getOffices(),
            'mygroup'       =>  $this->getUsersGroup($userId),
            'privileges' => Privileges::find()->asArray()->all(),
            'myprivileges'  => $this->getUsersPrivileges($userId),
        ]);
    }

    private function getUsersPrivileges($userId): array
    {
        $group = $this->getUsersGroup($userId);
        $access = [];

        $tmp = PrivilegesUsers::find()
            ->select(['privilegesId'])
            ->andWhere(['=','group',$group])
            ->andWhere(['=','userId',$userId])
            ->andWhere(['=','status',1])
            ->asArray()->all();

        if (count($tmp) == 0) {
            $tmp = PrivilegesUsers::find()
                ->select(['privilegesId'])
                ->andWhere(['=','group',$group])
                ->andWhere(['=','userId',0])
                ->andWhere(['=','status',1])
                ->asArray()->all();
        }

        foreach($tmp as $i) {
            $access[$group][] = $i['privilegesId'];
        }

        return $access;
    }

    private function saveUser(User $user, $userData)
    {
        $toSave = false;
        if ($userData['password'] !== $userData['password_control']) {
            throw new \Exception('Passwords does not match');
        }
        if ($user->username != $userData['username']) {
            $user->username = $userData['username'];
            $toSave = true;
        }
        if (strlen(trim($userData['password'])) > 0) {
            $user->setPassword(trim($user['password']));
            $toSave = true;
        }
        if ($user->email !== $userData['email']) {
            $user->email = trim($userData['email']);
            $toSave = true;
        }

        $userGroup = Yii::$app->db->createCommand("select item_name from auth_assignment where user_id={$user->id}")->queryScalar();

        if (!$userGroup) {
            throw new \Exception ('This user was not added to any group!!!');
        }
        if ($userGroup !== $userData['auth_assignment']) {
            $toSave = true;
        }

        if ($toSave) {
            $user->save();
            Yii::$app
                ->db
                ->createCommand("UPDATE auth_assignment SET item_name='{$userData['auth_assignment']}' WHERE user_id={$user->id}")
                ->execute();
        }
    }

    private function saveAgent($userData, $officeId, $userId)
    {
        // save to agent table
        $agent = Agent::find()->andWhere(['=','user_id',$userId])->andWhere(['=','office_id',$officeId])->one();
        if (!$agent) {
            $agent = new Agent();
        }
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

    private function getUsersGroup($userId)
    {
        return Yii::$app->db->createCommand("select item_name from auth_assignment where user_id={$userId}")->queryScalar();
    }

    private function getAgentData($userId)
    {
        return Agent::find()->where(['=','user_id',$userId])->all();
    }

    private function getAuthItems()
    {
        return UserGroups::find()->asArray()->all();
    }

    private function getCommissions()
    {
        return Commissions::find()->where(['=','status',1])->asArray()->all();
    }

    private function getOffices()
    {
        return Office::find()->where(['=','status',1])->asArray()->all();
    }
}