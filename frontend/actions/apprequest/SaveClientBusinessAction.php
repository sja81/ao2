<?php
namespace frontend\actions\apprequest;

use common\models\client\ClientBusiness;
use common\models\Companies;
use common\models\sys\SysLog;
use Yii;
use yii\base\Action;
use yii\db\Exception;
use yii\web\Response;

class SaveClientBusinessAction extends Action
{
    private function saveCompany(array $item): int
    {
        $company = Companies::findOne(['company_id'=>$item['company_id']]);
        if (!$company) {
            $company = new Companies();
            $company->name = $item['name'];
            $company->country = $item['country'];
            $company->zip = $item['zip'];
            $company->town = $item['town'];
            $company->address = $item['address'];
            $company->company_id = $item['company_id'];
            if (strlen($item['email']) > 1) {
                $company->email = $item['email'];
            }
            $company->tax_id = $item['tax_id'];
            $company->legal_form = $item['legal_form'];
            if (strcmp($item['web'], 'https://') != 0) {
                $company->web = $item['web'];
            }
            if (strcmp($item['email'], '@') != 0) {
                $company->email = $item['email'];
            }
            if (strlen($item['contact_person']) > 0) {
                $company->contact_person = $item['contact_person'];
            }
            if (strlen($item['iban']) > 0) {
                $company->iban = $item['iban'];
                $company->bank_name = $item['bank_name'];
            }
            /*if (strlen($item['owned_controlled_by']) > 0) {
                $company->owned_controlled_by = $item['owned_controlled_by'];
            }*/
            if (strlen($item['industry']) > 0) {
                $company->industry = $item['industry'];
            }
            if (strlen($item['time_of_existence']) > 0) {
                $company->time_of_existence = $item['time_of_existence'];
            }
            if (strlen($item['mobile']) > 0) {
                $company->mobile = $item['mobile'];
                $company->mobile_area_code = $item['model_area_code'];
            }
            if (strlen($item['landline']) > 0) {
                $company->landline = $item['landline'];
                $company->landline_area_code = $item['landline_area_code'];
            }
            if (strlen($item['mobile']) > 0) {
                $company->mobile = $item['mobile'];
                $company->mobile_area_code = $item['model_area_code'];
            }

            $company->save(false);
        }

        return $company->id;
    }

    private function saveBusiness(array $item, int $businessId, int $orderId, int $clientId)
    {
        $biz = new ClientBusiness();
        $biz->client_id = $clientId;
        $biz->order_id = $orderId;
        $biz->company_id = $businessId;
        $biz->total_yearly_income = $item['total_yearly_income'];
        $biz->tax_base = $item['tax_base'];
        $biz->tax = $item['tax'];
        $biz->save(false);
    }

    public function run()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $bizData = Yii::$app->request->post('bizdata');
        $clientId = Yii::$app->request->post('client_id');

        $pid = getmypid();

        if ((int)$clientId  == 0 ) {
            throw new Exception('Wrong client ID');
        }

        $tr = Yii::$app->db->beginTransaction();
        try {
            SysLog::WriteInfo($pid, 'AppRequestController', 'Starting to write clients business data');
            SysLog::WriteInfo($pid, 'AppRequestController', 'Client ID: ' . $clientId);

            $biz = [];
            foreach($bizData as $data) {
                $biz[$data['order']-1][$data['item']] = $data['val'];
            }

            foreach ($biz as $id=>$item) {
                $businessId = $this->saveCompany($item);
                $this->saveBusiness($item, $businessId, $id, $clientId);
            }

            $tr->commit();

        }catch(Exception $ex){
            SysLog::WriteError($pid,'AppRequestController',$ex->getMessage(),$ex->getLine());
            $tr->rollBack();
            return [
                'status'=>'error',
                'message'=>$ex->getMessage()
            ];
        }
        SysLog::WriteInfo($pid,'AppRequestController','Client business data were written successfuly');
        return [
            'status'=>'ok',
            'client_id'=>$clientId,
        ];
    }
}