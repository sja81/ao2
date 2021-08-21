<?php
namespace backend\actions\users;

use common\models\settings\Privileges;
use Yii;
use yii\helpers\Url;
use yii\base\Action;

class EditPrivilegeAction extends Action
{
    public function run()
    {
        if (is_null(Yii::$app->user->identity)) {
            return $this->controller->redirect(Url::to(['/site/login']));
        }

        $id = Yii::$app->request->get('id');
        $privilege = Privileges::findOne(['id'=>$id]);

        if (Yii::$app->request->isPost) {
            $postData = Yii::$app->request->post('Privilege');
            $tr = Yii::$app->db->beginTransaction();
            try {
                $privilege->name = trim($postData['name']);
                $privilege->description = trim($postData['description']);
                $privilege->save();
                $tr->commit();
                $this->controller->redirect(Url::to(['/users']));
            } catch (\Exception $e) {
                var_dump($e->getMessage());
                $tr->rollBack();
            }
        }

        return $this->controller->render('editprivileges',[
            'privilege' =>  $privilege
        ]);
    }

}