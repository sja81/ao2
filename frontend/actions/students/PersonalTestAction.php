<?php
namespace frontend\actions\students;

use yii\base\Action;

class PersonalTestAction extends Action
{
    public function run()
    {
        return $this->controller->render('tests/personal');
    }
}