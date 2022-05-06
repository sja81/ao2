<?php
namespace common\models\tasks;

use common\models\User;
use Yii;
use yii\db\ActiveRecord;

class Tasks extends ActiveRecord
{
    const UNASSIGNED_TASK = 'unassigned';

    private $stageScenarios = [
        'backlog'   => TasksStatuses::OPEN,
        'inprogress' => TasksStatuses::WIP,
        'review'    => TasksStatuses::REVIEW,
        'done'  =>  TasksStatuses::DONE
    ];

    public static function tableName()
    {
        return 'tasks';
    }

    public function getComment()
    {
        return $this->hasMany(TasksComments::class, ['taskId'=>'id']);
    }

    public function getNextTicketNumber(string $projectId): string
    {
        $ticketNumber = Yii::$app
            ->db
            ->createCommand("SELECT ticketNumber FROM tasks WHERE ticketNumber like '{$projectId}-%' ORDER BY id DESC LIMIT 1")
            ->queryScalar();
        if (!$ticketNumber) {
            return "{$projectId}-1";
        }
        $ticketNumber = explode('-',$ticketNumber);
        ++$ticketNumber[1];
        return implode('-',$ticketNumber);
    }

    public function updateStatus()
    {
        $oldStatus = $this->taskStatus;
        $userName = User::findOne(['id'=> Yii::$app->user->getId()])->getUserName();
        $this->taskStatus = $this->stageScenarios[$this->stage];
        $this->save();
        TasksHistory::addToHistory($this->id, $userName, 'taskStatus', $oldStatus, $this->stageScenarios[$this->stage]);
    }

    private function getRecipients(int $taskId, string $userName): array
    {
        $result[] = (User::findOne(['username'=>$userName]))->email;
        $task = self::findOne(['id'=>$taskId]);
        $result[] = (User::findOne(['username'=>$task->reporter]))->email;

        if (!is_null($task->assignee)) {
            $result[] = (User::findOne(['username'=>$task->assignee]))->email;
        }

        unset($task);

        return array_unique($result);
    }

    private function getTemplate(int $action): string
    {
        $templates = [
            1   =>  'stageUpdate-html'
        ];
        return $templates[$action];
    }

    private function getMailSubject(int $action): string
    {
        $subjects = [
            1 => Yii::t('app','stage was updated'),
        ];

        return $subjects[$action];
    }

    public static function sendNotification(int $taskId, string $userName, int $action, array $data = [])
    {
        $template = self::getTemplate($action);
        $subject = 'Tasker - ' . self::getMailSubject($action) ;
        $mailRecips = self::getRecipients($taskId, $userName);
        $messages = [];
        $vars = [
            'userName'  =>  $userName
        ];

        $vars = array_merge($vars, $data);

        foreach($mailRecips as $recip) {
            $messages[] =  Yii::$app
                ->mailer
                ->compose(['html' => $template],$vars)
                ->setFrom('tasker@aoreal.sk')
                ->setTo($recip['email'])
                ->setSubject($subject);
        }
        Yii::$app->mailer->sendMultiple($messages);
    }

}