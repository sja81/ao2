<?php
namespace common\models\mailer;

use Yii;
use common\models\tasks\Tasks;
use common\models\tasks\TasksProject;
use common\models\User;

class TaskerMail extends AoMailer
{
    const FORMAT_TEXT = 'text';
    const FORMAT_HTML = 'html';

    /**
     * @param Tasks $task
     * @param string $format
     */
    public function newTaskMail(Tasks $task, string $format=self::FORMAT_TEXT): void
    {
        $project = $this->getTaskProject($task->ticketNumber);
        $this->setData([
            'ticketNumber'      => $task->ticketNumber,
            'user'              => $task->reporter,
            'taskDateTime'      => $task->createdAt,
            'projekt'           => $project->name,
            'ticketTitle'       => $task->title
        ]);
        $emails = $this->getUserEmails($task);
        $this->setSubject('[TASKER] ' . Yii::t('app','Nový task ') . $task->ticketNumber . ': ' . $task->title);
        $this->setRecipients($emails);
        $this->setTemplate('newtask-text');
        $this->sendTextMessage();
    }

    /**
     * @param Tasks $task
     * @param string $oldStage
     * @param string $newStage
     * @param string $format
     */
    public function updateStageMail(Tasks $task, string $oldStage, string $newStage, string $format = self::FORMAT_TEXT): void
    {
        $project = $this->getTaskProject($task->ticketNumber);
        $this->setData([
            'ticketNumber'      => $task->ticketNumber,
            'user'              => $task->reporter,
            'projekt'           => $project->name,
            'ticketTitle'       => $task->title,
            'oldStage'          => $oldStage,
            'newStage'          => $newStage,
            'updateDate'        => $task->updatedAt
        ]);
        $emails = $this->getUserEmails($task);
        $this->setSubject('[TASKER] ' . Yii::t('app','Update task ') . $task->ticketNumber . ': ' . $task->title);
        $this->setRecipients($emails);
        $this->setTemplate('updatestage-text');
        $this->sendTextMessage();
    }

    /**
     * @param Tasks $task
     * @param string $oldPriority
     * @param string $newPriority
     * @param string $format
     * @param string $format
     */
    public function updatePriorityMail(Tasks $task, string $oldPriority, string $newPriority, string $format=self::FORMAT_TEXT): void
    {
        $project = $this->getTaskProject($task->ticketNumber);
        $this->setData([
            'ticketNumber'      => $task->ticketNumber,
            'user'              => $task->reporter,
            'projekt'           => $project->name,
            'ticketTitle'       => $task->title,
            'oldPriority'          => $oldPriority,
            'newPriority'          => $newPriority,
            'updateDate'        => $task->updatedAt
        ]);
        $emails = $this->getUserEmails($task);
        $this->setSubject('[TASKER] ' . Yii::t('app','Update task ') . $task->ticketNumber . ': ' . $task->title);
        $this->setRecipients($emails);
        $this->setTemplate('updatepriority-text');
        $this->sendTextMessage();
    }

    /**
     * @param Tasks $task
     * @param string $oldAssignee
     * @param string $newAssignee
     * @param string $format
     */
    public function updateAssigneeMail(Tasks $task, string $oldAssignee, string $newAssignee, string $format = self::FORMAT_TEXT): void
    {
        $project = $this->getTaskProject($task->ticketNumber);
        $this->setData([
            'ticketNumber'      => $task->ticketNumber,
            'user'              => $task->reporter,
            'projekt'           => $project->name,
            'ticketTitle'       => $task->title,
            'oldAssignee'          => $oldAssignee,
            'newAssignee'          => $newAssignee,
            'updateDate'        => $task->updatedAt
        ]);
        $emails = $this->getUserEmails($task);
        $this->setSubject('[TASKER] ' . Yii::t('app','Update task ') . $task->ticketNumber . ': ' . $task->title);
        $this->setRecipients($emails);
        $this->setTemplate('updateassignee-text');
        $this->sendTextMessage();
    }

    /**
     * @param Tasks $task
     * @return array
     */
    private function getUserEmails(Tasks $task): array
    {
        $user = User::findOne(['username'=>$task->reporter]);
        $emails[] = $user->email;
        if (!is_null($task->assignee) && $task->assignee != TASKS::UNASSIGNED_TASK) {
            $user = User::findOne(['username'=>$task->assignee]);
            $emails[] = $user->email;
        }
        return $emails;
    }

    /**
     * @param string $ticketNumber
     * @return TasksProject
     */
    private function getTaskProject(string $ticketNumber): TasksProject
    {
        $code = (explode("-",$ticketNumber))[0];
        return TasksProject::findOne(['code'=>$code]);
    }
}