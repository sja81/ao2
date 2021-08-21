<?php
namespace backend\actions\customers;

use Yii;
use yii\base\Action;
use yii\helpers\Url;
use common\models\Customer;
use common\models\Agent;

class IndexAction extends Action
{
    public function run()
    {
        if (is_null(Yii::$app->user->identity)) {
            return $this->controller->redirect(Url::to(['/site/login']));
        }

        $params = Yii::$app->request->get();
        $page = isset($params['p']) ? (int)$params['p'] : 1;
        $customers = [];

        if(Yii::$app->user->identity->hasRole('admin')) {
            $customers = Customer::find()
                            ->select([
                                'id',
                                'customer_type',
                                'name_first',
                                'name_last',
                                'lv_name_first',
                                'lv_name_last',
                                'ssn',
                                'email',
                                'phone',
                                'address',
                                'created_at',
                                'town',
                                'lv_town'
                            ]);
            $customerCountQuery = clone $customers;

            if (!is_null($page) && is_int($page) && $page > 0) {
                $customers->offset(($page-1) * 20)->limit(20);
            }
        } else {
            //get customers only for
        }




        return $this->controller->render('index',[
            'customers'     =>  $customers->all(),
            'customersCount' => $customerCountQuery->count(),
            'agents'        => (new Agent())->getActiveAgents()
        ]);
    }
}