<?php
namespace common\models\tasks;

use yii\db\ActiveRecord;

class TasksComments extends ActiveRecord
{
    public static function tableName()
    {
        return 'tasks_comment';
    }
}