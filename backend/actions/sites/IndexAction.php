<?php
namespace backend\actions\sites;

use common\models\Ucel;
use yii\base\Action;

class IndexAction extends Action
{

    public function init()
    {
        return parent::init();
    }

    public function run()
    {
        return $this->controller->render('index');
    }
}