<?php
namespace backend\actions\accounting;

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

        return $this->controller->render('invoice/add-received',[
            'offices'   =>  Office::find()->all(),
            'currencies' => Stat::find()->select(['mena'])->andWhere(['=','status',1])->distinct()->all(),
            'konst_symbol' => KonstantneSymboly::find()->all(),
        ]);
    }


}