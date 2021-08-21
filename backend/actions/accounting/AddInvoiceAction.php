<?php
namespace backend\actions\accounting;

use common\models\Accounting;
use common\models\Clients;
use common\models\KonstantneSymboly;
use common\models\Mesto;
use common\models\Stat;
use common\models\FinancialInstitution;
use common\models\Office;
use Yii;
use yii\base\Action;
use yii\helpers\Url;

class AddInvoiceAction extends Action
{
    public function run()
    {
        if (is_null(Yii::$app->user->identity)) {
            return $this->controller->redirect(Url::to(['/site/login']));
        }

        $invoiceData = [];
        $dodavatelData = [];
        $odberatelData = [];
        $polozkyData = [];

        $accounting = new Accounting();

        if (Yii::$app->request->isPost) {

            $tr = Yii::$app->db->beginTransaction();
            try {

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

        $defaultOffice = Office::findOne(['default_company',1]);

        return $this->controller->render('invoice/add',[
            'lastInvoiceNumber' => $accounting->getNextInvoiceNumber($defaultOffice),
            'offices'    => Office::find()->andWhere(['=','status',1])->asArray()->all(),
            'default_office' => $defaultOffice,
            'var_symbol'    => $accounting->getVariabilnySymbol($defaultOffice),
            'swifts'    => FinancialInstitution::find()->select(['swift'])->andWhere(['=','status',1])->all(),
            'banks'     => (new FinancialInstitution())->getAllActiveBanks(false),
            'currencies' => Stat::find()->select(['mena'])->andWhere(['=','status',1])->distinct()->all(),
            'konst_symbol' => KonstantneSymboly::find()->all(),
            'mesto'  => $mesta,
            'sluzby' => $accounting->zoznamSluziebPreFakturu(),
            'clients'   => $clients->listAccountingClients(true),
        ]);
    }
}