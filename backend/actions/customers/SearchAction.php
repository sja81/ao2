<?php
namespace backend\actions\customers;

use common\models\Agent;
use Yii;
use yii\base\Action;
use yii\helpers\Url;
use common\models\Customer;

class SearchAction extends Action
{
    public function run()
    {
        if (is_null(Yii::$app->user->identity)) {
            return $this->controller->redirect(Url::to(['/site/login']));
        }

        $params = Yii::$app->request->get();

        $customers = [];


        if(Yii::$app->user->identity->hasRole('admin')) {
            $customers = Customer::find()
                ->select([
                    'id',
                    'name_first',
                    'name_last',
                    'rodne_cislo',
                    'ico',
                    'dic',
                    'icdph',
                    'email',
                    'phone',
                    'adresa'
                ]);
            if (!is_null($params['Ser']['meno'])) {
                $customers
                    ->orWhere("name_first LIKE '%{$params['Ser']['meno']}%' ")
                    ->orWhere("name_last LIKE '%{$params['Ser']['meno']}%'");
            }
            if (!is_null($params['Ser']['rcico'])) {
                $customers
                    ->andWhere("");
            }
            if (isset($params['p']) && !is_null($params['p']) && (int)$params['p'] > 0) {
                $customers->offset(((int)$params['p']-1) * 20)->limit(20);
            }
        } else {

        }

        return $this->controller->render('index',[
            'customers'     => $customers->asArray()->all(),
            'agents'        => (new Agent())->getActiveAgents()
        ]);
    }
}