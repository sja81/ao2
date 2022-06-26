<?php
namespace backend\actions\accounting;

use common\models\Invoice;
use common\models\InvoiceSupplier;
use common\models\KonstantneSymboly;
use common\models\Office;
use common\models\Stat;
use Yii;
use yii\base\Action;
use yii\helpers\Url;

class AddReceivedInvoiceAction extends Action
{
    public function run()
    {
        if (is_null(Yii::$app->user->identity)) {
            return $this->controller->redirect(Url::to(['/site/login']));
        }

        if(Yii::$app->request->isPost) 
        {
            $invoiceData = Yii::$app->request->post("Invoice");
            $invoice = new Invoice();
            
            foreach($invoiceData as $col => $value) {
                $invoice->$col = $value;
            }
            $invoice->save();

            $invoiceSupplierData = Yii::$app->request->post("InvoiceSupplier");
            $invoiceSupplier = new InvoiceSupplier();

            foreach($invoiceSupplierData as $col => $value) {
                $invoiceSupplier->$col = $value;
            }
            $invoiceSupplier->save();

            return $this->controller->redirect(Url::to("/backoffice/accounting/invoice"));
            
        }

        return $this->controller->render('invoice/add-received',[
            'offices'   =>  Office::find()->all(),
            'currencies' => Stat::find()->select(['mena'])->andWhere(['=','status',1])->distinct()->all(),
            'konst_symbol' => KonstantneSymboly::find()->all(),
        ]);
    }


}