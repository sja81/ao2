<?php

namespace backend\controllers;

use Yii;
use common\models\tasks\TasksProject;
use yii\web\Controller;

class TaskManagerController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        $sql = "SELECT
                    tc.*, lower(j.`name`) AS `name`
                FROM 
                    tasksColumn tc 
                JOIN
                    jazyk j ON j.id=tc.langId
                WHERE 
                    tc.`status`=1";

        return $this->render('index',[
            'projects'  => TasksProject::find()->where(['=','status',TasksProject::STATUS_ACTIVE])->asArray()->all(),
            'columns'   => Yii::$app->db->createCommand($sql)->queryAll()
        ]);
    }

    public function actionAddProject()
    {
        return $this->render('add/project');
    }

    public function actionEditProject(int $id)
    {
        $project = TasksProject::findOne(['id'=>$id]);
        return $this->render('edit/project',[
            'project'   =>  $project
        ]);
    }
}