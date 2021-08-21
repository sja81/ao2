<?php
namespace backend\actions\accounting;

use common\models\Clients;
use common\models\Accounting;
use Yii;
use common\models\CashReceipt;
use common\models\Mesto;
use common\models\Office;
use common\models\Stat;
use yii\base\Action;
use yii\helpers\Url;

class EditCashReceiptAction extends Action
{
    public function run(int $id)
    {
        if (is_null(Yii::$app->user->identity)) {
            return $this->controller->redirect(Url::to(['/site/login']));
        }

        $clients = new Clients();

        if (Yii::$app->request->isPost) {
            $tr = Yii::$app->db->beginTransaction();
            try {
                $accounting = new Accounting();
                $receiptData = Yii::$app->request->post('Doklad');
                $accounting->setReceiptData($receiptData);
                $accounting->updateReceipt();

                $clients->setData($receiptData);
                $clients->updateClient();

                $tr->commit();
            } catch (\Exception $e) {
                $tr->rollBack();
                echo $e->getMessage();
                echo $e->getLine();
                exit();
            }
            $this->controller->redirect(Url::to(['/accounting/cash-receipt']));
        }

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

        return $this->controller->render('cash/edit',[
            'mesto'     => $mesta,
            'office'    => Office::find()->andWhere(['=','status',1])->asArray()->all(),
            'currencies' => Stat::find()->select(['mena'])->andWhere(['=','status',1])->distinct()->all(),
            'doklad'    => CashReceipt::findOne(['id' => $id]),
            'clients'   => $clients->listAccountingClients(true),
        ]);
    }
}