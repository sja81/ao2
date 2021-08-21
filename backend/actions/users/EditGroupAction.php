<?php
namespace backend\actions\users;

use common\models\users\UserGroups;
use yii\base\Action;
use yii\helpers\Url;
use yii\db\Expression;
use Yii;

class EditGroupAction extends Action
{
    public function run()
    {
        if (is_null(Yii::$app->user->identity)) {
            return $this->controller->redirect(Url::to(['/site/login']));
        }

        $name = Yii::$app->request->get('name');
        $group = UserGroups::find()->where(['=','name',$name])->one();

        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post('UserGroup');
            $tr = Yii::$app->db->beginTransaction();
            try {
                $group->name = $data['name'];
                $group->description = $data['description'];
                $group->updated_at = new Expression('NOW()');
                $group->save();
                $tr->commit();
                $this->controller->redirect(Url::to(['/users']));
            }catch(\Exception $e) {
                $tr->rollBack();
            }
        }

        return $this->controller->render('editgroup',[
            'group' => $group
        ]);
    }
}