<?php
namespace backend\actions\obhliadka;

use yii\base\Action;

class IndexAction extends Action
{
    public function run()
    {
        return $this->controller->render('index');
    }
}