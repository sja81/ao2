<?php
namespace backend\actions\accounting;

use common\models\Accounting;
use common\models\Invoice;
use common\models\KonstantneSymboly;
use common\models\Mesto;
use common\models\Office;
use common\models\Stat;
use Yii;
use yii\base\Action;
use yii\helpers\Url;

class MakeInvoiceAction extends Action
{
    public function run()
    {
        if (is_null(Yii::$app->user->identity)) {
            return $this->controller->redirect(Url::to(['/site/login']));
        }

        if (Yii::$app->request->isPost) {

            $tr = Yii::$app->db->beginTransaction();
            try {
                $accounting = new Accounting();
                $invoiceData = Yii::$app->request->post('Invoice');
                $dodavatelData = Yii::$app->request->post('Dodavatel');
                $odberatelData = Yii::$app->request->post('Odberatel');
                $polozkyData = Yii::$app->request->post('Polozky');
                $accounting->setInvoiceData($invoiceData);
                $accounting->setOdberatelData($odberatelData);
                $accounting->setDodavatelData($dodavatelData);
                $accounting->setPolozkyData($polozkyData);

                $accounting->buildInvoice();

                $tr->commit();

            } catch (Exception $e) {
                $tr->rollBack();
                echo $e->getMessage();
                echo $e->getLine();
                exit();
            }
            $this->controller->redirect(Url::to(['/accounting/invoice']));
        }


        $id = Yii::$app->request->get('id');
        $invoice = Invoice::findOne(['id'=>$id]);

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

        $office = Office::findOne(['id'=>$invoice->dodavatel->dodavatel_id]);

        return $this->controller->render('invoice/make-invoice',[
            'invoice'   =>  $invoice,
            'mesto'     =>  $mesta,
            'office'    =>  $office,
            'konst_symbol' => KonstantneSymboly::find()->all(),
            'currencies' => Stat::find()->select(['mena'])->andWhere(['=','status',1])->distinct()->all(),
            'lastInvoiceNumber' => (new Accounting())->getNextInvoiceNumber($office),
            'sluzby' => (new Accounting())->zoznamSluziebPreFakturu(),
        ]);
    }
}