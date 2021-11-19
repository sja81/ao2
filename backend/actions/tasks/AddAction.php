<?php
namespace backend\actions\tasks;

use common\models\tasks\Tasks;
use common\models\tasks\TasksStages;
use common\models\tasks\TasksStatuses;
use common\models\users\UserGroups;
use yii\base\Action;
use Yii;
use yii\db\Expression;
use yii\helpers\Url;
use common\models\User;
use common\models\tasks\BoardProjects;

class AddAction extends Action
{
    public function run()
    {
        if (is_null(Yii::$app->user->identity)) {
            return $this->controller->redirect(Url::to(['/site/login']));
        }
        if (Yii::$app->request->isPost) {
            $tr = Yii::$app->db->beginTransaction();
            try {
                $data = Yii::$app->request->post('Task');
                $this->saveTask($data);
                $tr->commit();
                Yii::$app->session->setFlash('success',Yii::t('app','Úloha boli pridaná'));
                return $this->controller->redirect(Url::to(['/tasks']));

            } catch (\Exception $e) {
                $tr->rollBack();
                Yii::$app->session->setFlash('error',$e->getMessage());
            }
        }

        return $this->controller->render('add',[
            'boardProjects' => BoardProjects::find()->asArray()->all(),
            'users' => User::find()->select(['username'])->where(['=','status',User::STATUS_ACTIVE])->asArray()->all(),
            'postData'  => isset($data) ? $data : [],
            'groups'    => UserGroups::find()->where(['>','type',0])->asArray()->all()
        ]);
    }

    private function saveTask(array $data): void
    {
        $task = new Tasks();
        $task->boardId=0;
        $task->createdAt = new Expression('now()');
        $task->updatedAt = new Expression('now()');
        $task->updatedBy = User::findOne(['id'=> Yii::$app->user->getId()])->getUserName();
        $task->reporter = User::findOne(['id'=> Yii::$app->user->getId()])->getUserName();
        $task->stage = TasksStages::BACKLOG;
        $task->taskStatus = TasksStatuses::OPEN;

        foreach($data as $key => $value) {
            if ($key == 'project') {
                $task->ticketNumber = $task->getNextTicketNumber($value);
                continue;
            }
            $task->$key = $value;
        }

        $task->save();
    }
}
