<?php
namespace common\models\tasks;

use yii\db\ActiveRecord;

class TasksColumn extends ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 0;

    public static function tableName()
    {
        return 'tasksColumn';
    }
}