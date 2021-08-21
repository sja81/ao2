<?php
namespace backend\actions\users;

use common\models\settings\Privileges;
use Yii;
use yii\base\Action;
use yii\helpers\Url;

class AddPrivilegeAction extends Action
{
    public function run()
    {
        if (is_null(Yii::$app->user->identity)) {
            return $this->controller->redirect(Url::to(['/site/login']));
        }

        if (Yii::$app->request->isPost) {
            $privileges = Yii::$app->request->post('Privileges');
            $tr = Yii::$app->db->beginTransaction();
            try {
                $this->addPrivileges($privileges);
                $tr->commit();
                $this->controller->redirect(Url::to(['index']));
            } catch(\Exception $e) {
                var_dump($e->getMessage());
                $tr->rollBack();
            }
        }

        return $this->controller->render('addprivileges');
    }

    private function addPrivileges($privileges)
    {
        $countPrivileges = count($privileges['name']);
        for($i=0;$i<$countPrivileges;$i++) {
            $privilege = new Privileges();
            $privilege->name = trim($privileges['name'][$i]);
            $privilege->description = trim($privileges['description'][$i]);
            $privilege->save();
        }
    }
}