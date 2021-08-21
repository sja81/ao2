<?php
namespace backend\actions\accounting;

use common\models\Clients;
use common\models\Accounting;
use common\models\Mesto;
use common\models\Office;
use common\models\Stat;
use Yii;
use yii\base\Action;
use yii\helpers\Url;

class AddReceiptAction extends Action
{
    public function run()
    {
        if (is_null(Yii::$app->user->identity)) {
            return $this->controller->redirect(Url::to(['/site/login']));
        }

        $receiptData = [];
        $clients = new Clients();

        if (Yii::$app->request->isPost) {
            $tr = Yii::$app->db->beginTransaction();
            try {
                $accounting = new Accounting();
                $receiptData = Yii::$app->request->post('Doklad');
                $accounting->setReceiptData($receiptData);
                $accounting->createReceipt();

                $clients->setData($receiptData);
                $clients->insertClient();

                $tr->commit();
            } catch (\Exception $e) {
                $tr->rollBack();
                echo $e->getMessage();
                echo $e->getLine();
                exit();
            }
            $this->controller->redirect(Url::to(['/accounting/cash-receipt']));
        }

        $defaultOffice = Office::findOne(['default_company'=>1]);

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

        return $this->controller->render('cash/add',[
            'default_office'    => $defaultOffice,
            'mesto'             => $mesta,
            'office'    => Office::find()->andWhere(['=','status',1])->asArray()->all(),
            'currencies' => Stat::find()->select(['mena'])->andWhere(['=','status',1])->distinct()->all(),
            'receiptData'   => $receiptData,
            'clients'   => $clients->listAccountingClients(true),
        ]);
    }
}