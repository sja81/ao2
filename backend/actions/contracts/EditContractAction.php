<?php
namespace backend\actions\contracts;

use common\models\ZmluvaAgent;
use common\models\ZmluvaNehnutelnost;
use Yii;
use common\models\Agent;
use common\models\ContractAgent;
use common\models\NehnutKategoria;
use common\models\Zmluva;
use yii\base\Action;
use yii\helpers\Url;

class EditContractAction extends Action
{
    public function run(int $id)
    {
        if (is_null(Yii::$app->user->identity)) {
            return $this->controller->redirect(Url::to(['/site/login']));
        }

        return $this->controller->render('edit/makler-nehnutelnost',[
            'agents'    => (new Agent())->getAllActiveAgents(),
            'kategorie' => NehnutKategoria::getVsetkyKategorie(),
            'zmluva'    => Zmluva::findOne(['id'=>$id]),
            'agent'     => ZmluvaAgent::findOne(['zmluva_id'=>$id]),
            'nehnutelnost' => (ZmluvaNehnutelnost::findOne(['zmluva_id'=>$id]))->nehnutelnost,
        ]);
    }
}