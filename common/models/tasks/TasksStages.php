<?php
namespace common\models\tasks;

final class TasksStages
{
    const BACKLOG = 'backlog';
    const IN_PROGRESS = 'inprogress';
    const REVIEW = 'review';
    const DONE = 'done';

    public static function getTaskStages(): array
    {
        return [
            self::BACKLOG => 'Backlog',
            self::IN_PROGRESS => 'In progress',
            self::REVIEW => 'Review',
            self::DONE => 'Done',
        ];
    }
}