<?php
namespace frontend\actions\cuba;

use yii\base\Action;

class IndexAction extends Action
{
    /**
     * @return string
     */
    public function run(): string
    {
        return $this->controller->render('index');
    }
}