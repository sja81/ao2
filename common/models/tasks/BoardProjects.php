<?php
namespace common\models\tasks;

use yii\db\ActiveRecord;

class BoardProjects extends ActiveRecord
{
    public static function tableName()
    {
        return 'tasksProject';
    }
}