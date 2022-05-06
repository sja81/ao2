<?php
namespace backend\controllers;

use common\models\mailer\TaskerMail;
use common\models\tasks\Tasks;
use common\models\tasks\TasksComments;
use common\models\tasks\TasksHistory;
use common\models\tasks\TasksLogTime;
use common\models\tasks\TasksStages;
use common\models\tasks\TasksStatuses;
use yii\db\Expression;
use yii\web\Controller;
use yii\web\Response;
use Yii;
use common\models\User;
use common\models\tasks\TaskAction;

class TasksController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'index' => [
                'class' => 'backend\actions\tasks\IndexAction'
            ],
            'issue' => [
                'class' =>  'backend\actions\tasks\IssueAction'
            ],
            'add'   => [
                'class' =>  'backend\actions\tasks\AddAction'
            ]
        ];
    }

    public function actionLogTime()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $logData = Yii::$app->request->post('timedata');
        $ticketId = Yii::$app->request->post('ticketid');
        $userName = User::findOne(['id'=> Yii::$app->user->getId()])->getUserName();
        $ticket = Tasks::findOne(['id'=>$ticketId]);
        if(!$ticket) {
            return ['status'=>'error','message'=>Yii::t('app','Tiket nebol nájdený')];
        }

        $logs = [];
        array_walk($logData, function($value, $key) use (&$logs){
           $logs[$value['item']] = $value['value'];
        });

        $tr = Yii::$app->db->beginTransaction();
        try{
            if (is_null($logs['loggedDateFrom'])) {
                $date = new \DateTime($logs['loggedDateTo']);
                $this->writeLog($ticketId, $userName, $logs['workedHours'], $logs['note'], $date);
            } else {
                $date = new \DateTime($logs['loggedDateFrom']);
                $dateTo = new \DateTime($logs['loggedDateTo']);
                do{
                    $this->writeLog($ticketId, $userName, $logs['workedHours'], $logs['note'], $date);
                    $date->modify('+1 day');
                } while($date <= $dateTo);
            }
            $tr->commit();
        } catch(\Exception $ex) {
            $tr->rollBack();
            return ['status'=>'error','message'=>$ex->getMessage()];
        }

        return ['status'=>'ok'];
    }

    private function writeLog(int $ticketId, string $userName, string $workedHours, string $note, \DateTime $date)
    {
        $ticket = Tasks::findOne(['id'=>$ticketId]);
        $log = new TasksLogTime();
        $log->taskId=$ticketId;
        $log->loggedBy = $userName;
        $log->loggedById = Yii::$app->user->getId();
        $log->workedHours = $workedHours;
        $log->note = $note === '' ?: "Working on issue {$ticket->ticketNumber}";
        $log->loggedDate = $date->format('Y-m-d H:i:s');
        $log->save();
        unset($ticket);
        TasksHistory::addToHistory($ticketId, $userName,'logtime',  '', "user worked {$workedHours}");
    }

    public function actionUpdateStage()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $stage = Yii::$app->request->post('stage');
        $ticketId = Yii::$app->request->post('ticketid');
        $userName = User::findOne(['id'=> Yii::$app->user->getId()])->getUserName();

        $ticket = Tasks::findOne(['id'=>$ticketId]);
        if(!$ticket) {
            return ['status'=>'error','message'=>Yii::t('app','Tiket nebol nájdený')];
        }
        $oldStage = $ticket->stage;
        $ticket->stage = $stage;
        $ticket->updatedAt = (new \DateTimeImmutable())->format("Y-m-d H:i:s");
        $ticket->save();
        TasksHistory::addToHistory($ticketId, $userName,'stage',  $oldStage, $stage);
        $ticket->updateStatus();

        (new TaskerMail())->updateStageMail($ticket, $oldStage, $stage, $userName);

        return ['status'=>'ok','newStatus' => $ticket->taskStatus];
    }

    public function actionUpdatePriority()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $priority = Yii::$app->request->post('priority');
        $ticketId = Yii::$app->request->post('ticketid');
        $userName = User::findOne(['id'=> Yii::$app->user->getId()])->getUserName();

        $ticket = Tasks::findOne(['id'=>$ticketId]);
        if(!$ticket) {
            return ['status'=>'error','message'=>Yii::t('app','Tiket nebol nájdený')];
        }
        $oldPriority = $ticket->priority;
        $ticket->priority = $priority;
        $ticket->updatedAt = (new \DateTimeImmutable())->format("Y-m-d H:i:s");
        $ticket->save();
        TasksHistory::addToHistory($ticketId, $userName,'priority',  $oldPriority, $priority);

        (new TaskerMail())->updatePriorityMail($ticket, $oldPriority, $priority, $userName);

        return ['status'=>'ok','newPriority' => $ticket->priority];
    }

    public function actionUpdateAssignee()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $assignee = Yii::$app->request->post('assignee');
        $ticketId = Yii::$app->request->post('ticketid');
        $userName = User::findOne(['id'=> Yii::$app->user->getId()])->getUserName();

        $ticket = Tasks::findOne(['id'=>$ticketId]);
        if(!$ticket) {
            return ['status'=>'error','message'=>Yii::t('app','Tiket nebol nájdený')];
        }

        $oldAssignee = $ticket->assignee;
        $ticket->assignee = $assignee;
        $ticket->updatedAt = new Expression('now()');
        $ticket->save();
        TasksHistory::addToHistory($ticketId, $userName,'assignee',  $oldAssignee, $assignee);

        (new TaskerMail())->updateAssigneeMail($ticket, $oldAssignee, $assignee);

        return ['status'=>'ok','newAssignee' => $ticket->assignee];
    }

    public function actionUpdateDueDate()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $dueDate = Yii::$app->request->post('duedate');
        $ticketId = Yii::$app->request->post('ticketid');
        $userName = User::findOne(['id'=> Yii::$app->user->getId()])->getUserName();

        $ticket = Tasks::findOne(['id'=>$ticketId]);
        if(!$ticket) {
            return ['status'=>'error','message'=>Yii::t('app','Tiket nebol nájdený')];
        }

        $oldDueDate = $ticket->dueDate;
        $ticket->dueDate = $dueDate;
        $ticket->updatedAt = new Expression('now()');
        $ticket->save();
        TasksHistory::addToHistory($ticketId, $userName,'due date',  $oldDueDate, $dueDate);

        return ['status'=>'ok','newDueDate' => $ticket->dueDate];
    }

    public function actionUpdateDescription()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $description = Yii::$app->request->post('descr');
        $ticketId = Yii::$app->request->post('ticketid');
        $userName = User::findOne(['id'=> Yii::$app->user->getId()])->getUserName();

        $ticket = Tasks::findOne(['id'=>$ticketId]);
        if(!$ticket) {
            return ['status'=>'error','message'=>Yii::t('app','Tiket nebol nájdený')];
        }

        $oldDescr = $ticket->summary;
        $ticket->summary = $description;
        $ticket->updatedAt = new Expression('now()');
        $ticket->save();

        TasksHistory::addToHistory($ticketId, $userName,'summary',  $oldDescr, $description);

        return ['status'=>'ok'];
    }

    public function actionUpdateTitle()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $title = Yii::$app->request->post('title');
        $ticketId = Yii::$app->request->post('ticketid');
        $userName = User::findOne(['id'=> Yii::$app->user->getId()])->getUserName();

        $ticket = Tasks::findOne(['id'=>$ticketId]);
        if(!$ticket) {
            return ['status'=>'error','message'=>Yii::t('app','Tiket nebol nájdený')];
        }

        $oldTitle = $ticket->title;
        $ticket->title = $title;
        $ticket->updatedAt = new Expression('now()');
        $ticket->save();

        TasksHistory::addToHistory($ticketId, $userName,'summary',  $oldTitle, $title);

        return ['status'=>'ok'];
    }

    public function actionSaveComment()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $content = Yii::$app->request->post('comment');
        $ticketId = Yii::$app->request->post('ticketid');
        $userName = User::findOne(['id'=> Yii::$app->user->getId()])->getUserName();
        $ticket = Tasks::findOne(['id'=>$ticketId]);
        if(!$ticket) {
            return ['status'=>'error','message'=>Yii::t('app','Tiket nebol nájdený')];
        }
        unset($ticket);
        $tr = Yii::$app->db->beginTransaction();
        try {
            $comment = new TasksComments();
            $comment->taskId = $ticketId;
            $comment->summary = $content;
            $comment->createdBy = $userName;
            $comment->createdById = Yii::$app->user->getId();
            $comment->createdAt = new Expression('NOW()');
            $comment->save();

            $tr->commit();
        } catch(\Exception $ex) {
            $tr->rollBack();
            return ['status'=>'error', 'message'=>$ex->getMessage()];
        }

        return ['status'=>'ok'];
    }

    public function actionSaveTask()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $data = Yii::$app->request->post('task');
        $task = new Tasks();
        $task->boardId=0;
        $task->createdAt = new Expression('now()');
        $task->updatedAt = new Expression('now()');
        $task->updatedBy = User::findOne(['id'=> Yii::$app->user->getId()])->getUserName();
        $task->reporter = User::findOne(['id'=> Yii::$app->user->getId()])->getUserName();
        $task->stage = TasksStages::BACKLOG;
        $task->taskStatus = TasksStatuses::OPEN;

        foreach($data as $item) {
            if ($item['item'] == 'project') {
                $task->ticketNumber = $task->getNextTicketNumber($item['value']);
                continue;
            }
            $v = $item['item'];
            $task->$v = $item['value'];
        }

        $res = $task->save();
        if (!$res) {
            return ['status'=>'error','message'=>Yii::t('app','Úlohu sa nepodarilo uložiť')];
        }

        $taskItem = $this->renderPartial('task-item',[
            'ticketId'    =>  $task->id,
            'ticketNumber'  => $task->ticketNumber,
            'priority'  =>  $task->priority,
            'status'    =>  TasksStatuses::OPEN,
            'title'     =>  $task->title
        ]);

        return ['status'=>'ok','task'=> $taskItem];
    }
}