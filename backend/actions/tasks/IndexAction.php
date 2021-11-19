<?php
namespace backend\actions\tasks;

use common\models\tasks\TasksColumn;
use common\models\User;
use Yii;
use yii\base\Action;
use yii\helpers\Url;
use common\models\tasks\Tasks;

class IndexAction extends Action
{
    public function run()
    {
        if (is_null(Yii::$app->user->identity)) {
            return $this->controller->redirect(Url::to(['/site/login']));
        }

        if (Yii::$app->user->identity->hasRole('admin')) {
            $tasks = Tasks::find();
        } else {
            $userName = User::findOne(['id'=> Yii::$app->user->getId()])->getUserName();
            $tasks = Tasks::find()->orWhere(['=','reporter',$userName])->orWhere(['=','assignee',$userName]);
        }

        return $this->controller->render('index',[
            'tasks'  =>  $tasks->asArray()->all(),
            'boardColumns' => TasksColumn::find()->orderBy('columnOrder ASC')->asArray()->all(),
            'users' => User::find()->select(['username'])->where(['=','status',User::STATUS_ACTIVE])->asArray()->all()
        ]);
    }
}