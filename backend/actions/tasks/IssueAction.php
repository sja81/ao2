<?php
namespace backend\actions\tasks;

use common\models\tasks\TasksComments;
use common\models\tasks\TasksHistory;
use common\models\tasks\TasksLogTime;
use common\models\tasks\TasksPriority;
use common\models\tasks\TasksStages;
use common\models\User;
use yii\base\Action;
use yii\helpers\Url;
use Yii;
use common\models\tasks\Tasks;

class IssueAction extends Action
{
    public function run()
    {
        if (is_null(Yii::$app->user->identity)) {
            return $this->controller->redirect(Url::to(['/site/login']));
        }
        $id = Yii::$app->request->get('id');

        return $this->controller->render('issue',[
            'task'  => Tasks::findOne(['id'=>$id]),
            'comments' => TasksComments::find()->where(['=','taskId',$id])->asArray()->all(),
            'stages' => TasksStages::getTaskStages(),
            'priorities' => TasksPriority::getPriorities(),
            'users' => User::find()->select(['username'])->where(['=','status',User::STATUS_ACTIVE])->asArray()->all(),
            'history' => TasksHistory::getHistory($id),
            'worklogs' => TasksLogTime::find()->where(['=','taskId',$id])->asArray()->all()
        ]);
    }
}