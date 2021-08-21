<?php
namespace backend\actions\customers;

use common\models\Customer;
use yii\base\Action;

class OpenAction extends Action
{
    public function run($id)
    {
        return $this->controller->render('open',[
            'customer'      => Customer::findOne(['id'=>$id])
        ]);
    }
}