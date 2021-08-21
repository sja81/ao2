<?php
namespace backend\actions\contracts;

use common\models\Customer;
use common\models\CustomerCompany;
use Yii;
use yii\base\Action;
use yii\helpers\Url;

class SaveMajiteliaAction extends Action
{
    public function run()
    {
        $request = Yii::$app->request->post('Data');
        $customers = $request['customer'];

        try{
            foreach($customers as $item){
                if ($item['lv_name_last'] == '') {
                    continue;
                }
                $customer = new Customer();
                $customer->pridajZakaznika($item);
                $customer->pripojZakaznikaKuZmluve($request['zmluva_id']);

                if ($item['ico'] != '') {
                    $company = new CustomerCompany();
                    $company->customer_id = $customer->id;
                    $company->obchodne_meno = $item['obchodne_meno'];
                    $company->ico = $item['ico'];
                    $company->dic = $item['dic'];
                    $company->icdph = $item['icdph'];
                    $company->status=1;
                    $company->created_by = Yii::$app->user->identity->id;
                    $ret = $company->save();
                    if( !$ret ) {
                        throw new Exception('Neviem ulozit firmu k zakaznikovi');
                    }
                }

            }

            $this->controller->redirect(Url::to(['/contracts/basic-info','id'=>$request['zmluva_id']]));

        } catch(\Exception $ex) {
            echo $ex->getMessage();
            echo $ex->getLine();
            exit;
        }

    }
}