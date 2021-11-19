<?php
namespace common\models\tasks;

use yii\db\ActiveRecord;

class TasksLogTime extends ActiveRecord
{
    public static function tableName()
    {
        return 'tasksLogTime';
    }

}