<?php
namespace frontend\actions\applicant;

use yii\base\Action;

class WrittingTestAction extends Action
{
    public function run()
    {
        $this->controller->layout = 'applicant';
        return $this->controller->render('writting-test/index');
    }
}