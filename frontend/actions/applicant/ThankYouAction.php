<?php
namespace frontend\actions\applicant;

use yii\base\Action;

class ThankYouAction extends Action
{
    public function run()
    {
        $this->controller->layout = 'applicant';
        return $this->controller->render('thank-you/index');
    }
}