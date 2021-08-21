<?php
namespace backend\actions\accounting;

use common\models\CashReceipt;
use common\models\CashReceiptCustomer;
use common\models\CashReceiptSupplier;
use common\models\Clients;
use common\models\Office;
use Yii;
use yii\base\Action;
use yii\helpers\Url;

class CashReceiptAction extends Action
{
    public function run()
    {
        if (is_null(Yii::$app->user->identity)) {
            return $this->controller->redirect(Url::to(['/site/login']));
        }

        $params = Yii::$app->request->get();
        $page = isset($params['p']) ? (int)$params['p'] : 1;
        $receips = CashReceipt::find();
        $where = [];
        $receiptCountQuery = clone $receips;

        if (isset($params['rok']) && $params['rok'] !== '') {
            $where[] = "vystavene like '%{$params['rok']}%'";
        }

        if (isset($params['dt']) && $params['dt'] !== '') {
            $where[] = "pp_typ='{$params['dt']}'";
        }

        if (isset($params['st']) && $params['st'] !== '') {
            $where[] = "status='{$params['st']}'";
        }

        if (isset($params['odber'])) {
            $orWhere  = [];
            foreach($params['odber'] as $it) {
                $orWhere[] = "pokladnicny_doklad_odberatel.nazov like '%{$it}%'";
                $orWhere[] = "pokladnicny_doklad_odberatel.kontaktna_osoba like '%{$it}%'";
            }
            if (!empty($orWhere)) {
                $where[] = '('.implode(' or ',$orWhere).')';
                $receips->innerJoin('pokladnicny_doklad_odberatel','pokladnicny_doklad_odberatel.doklad_id=pokladnicny_doklad.id');
            }
        }

        if (isset($params['dodav'])) {
            $orWhere  = [];
            foreach($params['dodav'] as $it) {
                $orWhere[] = "pokladnicny_doklad_dodavatel.nazov like '%{$it}%'";
                $orWhere[] = "pokladnicny_doklad_dodavatel.kontaktna_osoba like '%{$it}%'";
            }
            if (!empty($orWhere)) {
                $where[] = '('.implode(' or ',$orWhere).')';
                $receips->innerJoin('pokladnicny_doklad_dodavatel','pokladnicny_doklad_dodavatel.doklad_id=pokladnicny_doklad.id');
            }
        }

        if (!empty($where)) {
            $andWhere = implode(' and ',$where);
            $receips->where($andWhere);
        }

        if (!is_null($page) && is_int($page) && $page > 0) {
            $receips->offset(($page-1) * 20)->limit(20);
        }

        return $this->controller->render('cash/index',[
            'doklady'   =>  $receips->all(),
            'pocet'     =>  $receiptCountQuery->count(),
            'akt_strana'    => $page,
            'office'    => CashReceiptSupplier::find()->select(['nazov'])->distinct()->all(),
            'clients'   => CashReceiptCustomer::find()->select(['nazov','kontaktna_osoba'])->all(),
        ]);
    }
}