<?php
namespace backend\actions\users;

use common\models\settings\Privileges;
use common\models\users\PrivilegesUsers;
use common\models\users\UserGroups;
use yii\base\Action;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use Yii;

class IndexAction extends Action
{
    public function run()
    {
        if (is_null(Yii::$app->user->identity)) {
            return $this->controller->redirect(Url::to(['/site/login']));
        }
        return $this->controller->render('index',[
            'userlist'  => $this->getUserList(),
            'usergroups' => UserGroups::find()->asArray()->all(),
            'privileges' => Privileges::find()->asArray()->all(),
            'groupmatrix'   => $this->getGroupAccessMatrix()
        ]);
    }

    private function getGroupAccessMatrix()
    {
        $matrix = UserGroups::find()->select(['name'])->asArray()->all();
        $access = [];
        foreach($matrix as $item){
            $tmp = PrivilegesUsers::find()
                ->select(['privilegesId'])
                ->andWhere(['=','group',$item['name']])
                ->andWhere(['=','userId',0])
                ->andWhere(['=','status',1])
                ->asArray()->all();
            if (count($tmp) == 0) {
                $access[$item['name']] = [];
            } else {
                foreach($tmp as $i) {
                    $access[$item['name']][] = $i['privilegesId'];
                }
            }


        }
        return $access;
    }

    private function getUserList()
    {
        return Yii::$app->db->createCommand("
            SELECT
                u.id, 
                a.name_first,
                a.name_last,
                a.phone,
                u.email,
                u.username,
                u.status
            FROM 
                user u 
            LEFT JOIN 
                `agent` a ON u.id=a.user_id
            GROUP BY
                a.user_id
            order by u.id desc
        ")->queryAll();
    }
}