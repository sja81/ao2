<?php
namespace backend\actions\cms;

use common\models\Post;
use yii\base\Action;
use yii\helpers\Url;
use Yii;

class EditPostAction extends Action
{
    public function run()
    {
        if (is_null(Yii::$app->user->identity)) {
            return $this->controller->redirect(Url::to(['/site/login']));
        }

        $id = (int)Yii::$app->request->get('id');

        return $this->controller->render('posts/edit',[
            'post'  => Post::findOne(['id'=>$id])
        ]);
    }
}