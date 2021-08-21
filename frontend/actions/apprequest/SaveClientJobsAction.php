<?php
namespace frontend\actions\apprequest;

use common\models\client\ClientDetail;
use common\models\Companies;
use common\models\sys\SysLog;
use common\models\client\ClientJob;
use Yii;
use yii\base\Action;
use yii\db\Exception;
use yii\db\Expression;
use yii\web\Response;

class SaveClientJobsAction extends Action
{

    private function updateClientDetail(int $clientId, array $inputData)
    {
        $clientDetail = ClientDetail::findOne(['client_id'=>$clientId]);
        foreach($inputData as $data) {
            $item = $data['item'];
            if (strpos($item,"_from") !== false || strpos($item,"_to") !== false ) {
                $clientDetail->$item = (new \DateTime($data['val']))->format("Y-m-d");
            } else {
                $clientDetail->$item = $data['val'];
            }
        }
        $clientDetail->updated_at = new Expression('NOW()');
        $clientDetail->save(false);
    }

    private function saveCompany(array $item): int {
        $company = Companies::findOne(['company_id'=>$item['company_id']]);
        if (!$company) {
            $company = new Companies();
            $company->name = $item['employer_name'];
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
            if (strlen($item['owned_controlled_by']) > 0) {
                $company->owned_controlled_by = $item['owned_controlled_by'];
            }
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

    private function saveJob(array $item, int $employerId, int $orderId, int $clientId)
    {
        $job = new ClientJob();
        $job->order_id = $orderId + 1;
        $job->client_id = $clientId;
        $job->employer_id = $employerId;
        if (strlen($item['profession']) > 0) {
            $job->profession = $item['profession'];
        }
        if (strlen($item['employment_type']) > 0) {
            $job->employment_type = $item['employment_type'];
        }
        $job->netwage_1 = $item['netwage_1'];
        $job->netwage_2 = $item['netwage_2'];
        $job->netwage_3 = $item['netwage_3'];
        $job->netwage_4 = $item['netwage_4'];
        $job->netwage_5 = $item['netwage_5'];
        $job->netwage_6 = $item['netwage_6'];
        $job->netwage_7 = $item['netwage_7'];
        $job->netwage_8 = $item['netwage_8'];
        $job->netwage_9 = $item['netwage_9'];
        $job->netwage_10 = $item['netwage_10'];
        $job->netwage_11 = $item['netwage_11'];
        $job->netwage_12 = $item['netwage_12'];
        $job->avg_4month_netwage = $item['avg_4month_netwage'];
        $job->avg_6month_netwage = $item['avg_6month_netwage'];
        $job->avg_12month_netwage = $item['avg_12month_netwage'];

        $job->avg_12month_grosswage = $item['avg_12month_grosswage'];
        $job->sum_of_extra_income = $item['sum_of_extra_income'];
        $job->extra_wage = $item['extra_wage'];
        $job->bonus_freq = $item['bonus_freq'];
        $job->sum_of_bonuses = $item['sum_of_bonuses'];
        $job->payroll_payout = $item['payroll_payout'];
        if ($job->payroll_payout == 'account') {
            $job->payroll_iban = $item['payroll_iban'];
            $job->payroll_bank = $item['payroll_bank'];
        }
        if (strlen($item['worktime_in_profession']) >0){
            $job->worktime_in_profession = $item['worktime_in_profession'];
        }
        $job->work_term = $item['work_term'];
        $job->work_from = $item['work_from'];
        if ($item['work_term'] != 'permanent' ) {
            $job->work_to = $item['work_to'];
        }

        $job->save(false);
    }

    public function run()
    {

        Yii::$app->response->format = Response::FORMAT_JSON;
        $socialData = Yii::$app->request->post('socialdata');
        $clientJobs = Yii::$app->request->post('jobs');
        $clientId = Yii::$app->request->post('client_id');

        $pid = getmypid();

        if ((int)$clientId  == 0 ) {
            throw new Exception('Wrong client ID');
        }

        $tr = Yii::$app->db->beginTransaction();
        try {
            SysLog::WriteInfo($pid, 'AppRequestController', 'Starting to write clients jobs');
            SysLog::WriteInfo($pid, 'AppRequestController', 'Client ID: ' . $clientId);

            $this->updateClientDetail($clientId, $socialData);

            $jobs = [];
            foreach($clientJobs as $data) {
                $jobs[$data['order']-1][$data['item']] = $data['val'];
            }

            foreach($jobs as $id => $item) {

                $employerId = $this->saveCompany($item);
                $this->saveJob($item, $employerId, $id, $clientId);

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
        SysLog::WriteInfo($pid,'AppRequestController','Client jobs were written successfuly');
        return [
            'status'=>'ok',
            'client_id'=>$clientId,
        ];
    }
}