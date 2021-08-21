<?php
namespace backend\actions\users;

use common\models\users\UserGroups;
use Yii;
use yii\db\Expression;
use yii\helpers\Url;
use yii\base\Action;

class AddGroupAction extends Action
{
    public function run()
    {
        if (is_null(Yii::$app->user->identity)) {
            return $this->controller->redirect(Url::to(['/site/login']));
        }

        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post('UserGroup');
            $tr = Yii::$app->db->beginTransaction();
            try {
                $group = new UserGroups();
                $group->name = $data['name'];
                $group->description = $data['description'];
                $group->created_at = new Expression('NOW()');
                $group->updated_at = new Expression('NOW()');
                $group->type = 100;
                $group->save();
                $tr->commit();
                $this->controller->redirect(Url::to(['/users']));
            }catch(\Exception $e) {
                $tr->rollBack();

            }

        }

        return $this->controller->render('addgroup');
    }
}