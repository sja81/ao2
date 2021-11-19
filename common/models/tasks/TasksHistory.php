<?php
namespace common\models\tasks;

use Yii;

class TasksHistory
{
    public static function addToHistory(int $taskId, string $user, string $field, ?string $oldValue, ?string $newValue): int
    {
        $sql = "INSERT INTO tasksHistory VALUES (null, {$taskId}, '{$field}', '{$oldValue}','{$newValue}', NOW(), '{$user}')";
        return Yii::$app->db->createCommand($sql)->execute();
    }

    public static function getHistory(int $taskId): array
    {
        $sql = "SELECT * FROM tasksHistory WHERE taskId={$taskId}";
        return Yii::$app->db->createCommand($sql)->queryAll();
    }
}