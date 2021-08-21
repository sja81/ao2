<?php
namespace common\models\tasks;

use yii\db\ActiveRecord;

class Tasks extends ActiveRecord
{
    public static function tableName()
    {
        return 'tasks';
    }

    public function getComment()
    {
        return $this->hasMany(TasksComments::class, ['task_id'=>'id']);
    }
}