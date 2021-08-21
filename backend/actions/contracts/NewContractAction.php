<?php
namespace backend\actions\contracts;

use common\models\NehnutKategoria;
use common\models\Zmluva;
use yii\helpers\Url;
use common\models\Agent;
use Yii;
use yii\base\Action;
use yii\web\Cookie;

class NewContractAction extends Action
{
    protected function run()
    {
        if (is_null(Yii::$app->user->identity)) {
            return $this->controller->redirect(Url::to(['/site/login']));
        }

        $cislo = null;
        $zmluva = null;

        if (!Yii::$app->request->cookies->getValue('zmluva-cislo')) {
            $cislo = Zmluva::getCisloZmluvy();
            Yii::$app->response->cookies->add(new Cookie(['name'=>'zmluva-cislo','value'=>$cislo]));
            $zmluva = new Zmluva();
            $zmluva->pridajZmluvu($cislo, Yii::$app->user->identity->id);
            $zmluva->vytvorAdresare();
        } else {
            $cislo = Yii::$app->request->cookies->getValue('zmluva-cislo');
            $zmluva = Zmluva::findOne(['cislo'=>$cislo]);
        }

        $agents = Agent::getAgent(Yii::$app->user->id);
        if (Yii::$app->user->identity->hasRole('admin')) {
            $agents = Agent::getAllActiveAgents();
        }

        return $this->controller->render('new/makler-nehnutelnost',[
            'agents'    => $agents,
            'contract_number'   => $cislo,
            'zmluva_id' => $zmluva->id,
            'kategorie' => NehnutKategoria::getVsetkyKategorie(),
        ]);
    }
}