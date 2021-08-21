<?php
namespace frontend\actions\apprequest;

use common\models\client\ClientDetail;
use common\models\client\ClientExpenses;
use common\models\client\ClientOtherExpenses;
use common\models\client\ClientOtherIncomes;
use common\models\sys\SysLog;
use yii\base\Action;
use yii\db\Exception;
use yii\db\Expression;
use yii\web\Response;
use Yii;

class SaveClientCashflowAction extends Action
{
    public function run()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $otherIncomes = Yii::$app->request->post('other_income');
        $expenses = Yii::$app->request->post('expense');
        $otherExpenses = Yii::$app->request->post('other_expenses');

        $clientId = Yii::$app->request->post('client_id');
        $pid = getmypid();

        if ((int)$clientId  == 0 ) {
            throw new Exception('Wrong client ID');
        }

        $tr = Yii::$app->db->beginTransaction();
        try {
            SysLog::WriteInfo($pid, 'AppRequestController', 'Starting to write clients jobs');
            SysLog::WriteInfo($pid, 'AppRequestController', 'Client ID: ' . $clientId);

            $detail = ClientDetail::findOne(['client_id'=>$clientId]);
            $otherExpense = ClientOtherExpenses::findOne(['client_id'=>$clientId]);
            if (!$otherExpense) {
                $otherExpense = new ClientOtherExpenses();
                $otherExpense->client_id = $clientId;
            } else {
                $otherExpense->updated_at = new Expression('NOW()');
            }
            $otherIncome = ClientOtherIncomes::findOne(['client_id'=>$clientId]);
            if (!$otherIncome) {
                $otherIncome = new ClientOtherIncomes();
                $otherIncome->client_id = $clientId;
            } else {
                $otherIncome->updated_at = new Expression('NOW()');
            }

            foreach ($otherIncomes as $data) {
                if ($data['item'] == 'iban_for_loan_repay') {
                    $detail->iban_for_loan_repay = $data['val'];
                    $detail->updated_at = new Expression('NOW()');
                    $detail->save(false);
                } else if ($data['item'] == 'bank_for_loan_repay') {
                    $detail->bank_for_loan_repay = $data['val'];
                    $detail->updated_at = new Expression('NOW()');
                    $detail->save(false);
                } else {
                    $item = $data['item'];
                    $otherIncome->updated_at = new Expression('NOW()');
                    $otherIncome->$item = $data['val'];
                    $otherIncome->save(false);
                }
            }

            if (!is_null($expenses)) {
                $expense = ClientExpenses::findOne(['client_id'=>$clientId]);
                if (!$expense) {
                    $expense = new ClientExpenses();
                    $expense->client_id = $clientId;
                    $expense->created_at = new Expression('NOW()');
                }
                foreach ($expenses as $data) {
                    $item = $data['item'];
                    $expense->$item = $data['val'];
                }
                $expense->save(false);
            }

            foreach ($otherExpenses as $data) {
                $item = $data['item'];
                $otherExpense->$item = $data['val'];
            }
            $otherExpense->save(false);
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