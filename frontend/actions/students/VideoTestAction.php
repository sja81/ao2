<?php

namespace frontend\actions\students;

use yii\base\Action;

class VideoTestAction extends Action
{
    public function run()
    {
        return $this->controller->render('tests/video-test');
    }
}