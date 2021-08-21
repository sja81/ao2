<?php
namespace backend\actions\accounting;

use common\models\Accounting;
use common\models\Clients;
use common\models\FinancialInstitution;
use common\models\Invoice;
use common\models\KonstantneSymboly;
use common\models\Mesto;
use common\models\Office;
use common\models\Sluzby;
use common\models\Stat;
use Yii;
use yii\base\Action;
use yii\helpers\Url;

class EditInvoiceAction extends Action
{
    public function run(int $id)
    {
        if (is_null(Yii::$app->user->identity)) {
            return $this->controller->redirect(Url::to(['/site/login']));
        }

        $invoice = Invoice::findOne(['id'=>$id]);

        if (Yii::$app->request->isPost) {
            $tr = Yii::$app->db->beginTransaction();
            try{
                $accounting = new Accounting();
                $invoiceData = Yii::$app->request->post('Invoice');
                $dodavatelData = Yii::$app->request->post('Dodavatel');
                $odberatelData = Yii::$app->request->post('Odberatel');
                $polozkyData = Yii::$app->request->post('Polozky');

                $accounting->setInvoiceData($invoiceData);
                $accounting->setOdberatelData($odberatelData);
                $accounting->setDodavatelData($dodavatelData);
                $accounting->setPolozkyData($polozkyData);

                $accounting->buildInvoice($invoice);


                $tr->commit();

            }catch (Exception $e) {
                $tr->rollBack();
                echo $e->getMessage();
                echo $e->getLine();
                exit();
            }
            $this->controller->redirect(Url::to(['/accounting/invoice']));
        }

        $clients = new Clients();

        $mesta = Mesto::find()
            ->select([
                'mesto.nazov_obce',
                'stat.name as nazov_statu',
                'mesto.psc',
                'okres.name as nazov_okresu'
            ])
            ->innerJoin('stat','stat.id=mesto.stat_id')
            ->innerJoin('okres','mesto.okres_id=okres.id')
            ->asArray()
            ->all();

        return $this->controller->render('invoice/edit',[
            'office'    => $office = Office::findOne(['id'=>$invoice->dodavatel->dodavatel_id]),
            'invoice'       => $invoice,
            'mesto'         => $mesta,
            'offices'    => Office::find()->andWhere(['=','status',1])->asArray()->all(),
            'swifts'    => FinancialInstitution::find()->select(['swift'])->andWhere(['=','status',1])->all(),
            'banks'     => (new FinancialInstitution())->getAllActiveBanks(false),
            'currencies' => Stat::find()->select(['mena'])->andWhere(['=','status',1])->distinct()->all(),
            'konst_symbol' => KonstantneSymboly::find()->all(),
            'sluzby' => (new Accounting())->zoznamSluziebPreFakturu(),
            'clients'   => $clients->listAccountingClients(true),
        ]);
    }
}