<?php
namespace backend\controllers;

use common\models\users\PrivilegesUsers;
use Yii;
use yii\db\Expression;
use yii\web\Controller;
use yii\web\Response;

class UsersController extends Controller
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
                'class' =>  'backend\actions\users\IndexAction'
            ],
            'add'   => [
                'class' =>  'backend\actions\users\AddAction'
            ],
            'edit'  =>  [
                'class' =>  'backend\actions\users\EditAction'
            ],
            'add-group' => [
                'class' =>  'backend\actions\users\AddGroupAction'
            ],
            'add-privilege'   => [
                'class' =>  'backend\actions\users\AddPrivilegeAction'
            ],
            'edit-group'    =>  [
                'class' =>  'backend\actions\users\EditGroupAction'
            ],
            'edit-privilege' => [
                'class' =>  'backend\actions\users\EditPrivilegeAction'
            ]
        ];
    }

    public function actionAjaxChangePrivilege()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $group = Yii::$app->request->post('group');
        $privilege = Yii::$app->request->post('priv');
        $user = Yii::$app->request->post('user');
        $status = Yii::$app->request->post('status');
        $row = PrivilegesUsers::findOne([
           'group'  => $group,
           'userId' =>  $user,
           'privilegesId'   => $privilege
        ]);
        if (!$row) {
            $row = new PrivilegesUsers();
            $row->createdAt = new Expression('NOW()');
            $row->group = $group;
            $row->userId = $user;
            $row->privilegesId = $privilege;
        }
        $row->updatedAt = new Expression('NOW()');

        $tr = Yii::$app->db->beginTransaction();
        try {
            $row->status = (int)$status;
            $row->save();
            $tr->commit();
        } catch (\Exception $e) {
            $tr->rollBack();
            return ['status'=>'error','message'=>Yii::t('app','Status nebol zmenený!')];
        }
        return ['status'=>'ok','message'=>Yii::t('app','Status bol zmenený!')];

    }

}