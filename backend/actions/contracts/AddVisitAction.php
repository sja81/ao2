<?php
namespace backend\actions\contracts;

use common\models\Calendar;
use common\models\Konfiguracia;
use common\models\KonfiguraciaKategorie;
use common\models\Kraj;
use common\models\NehnutelnostDruhy;
use common\models\Office;
use common\models\Okres;
use common\models\Ucel;
use Yii;
use common\models\Agent;
use yii\helpers\Url;
use yii\base\Action;

class AddVisitAction extends Action
{
    public function run(int $id)
    {
        if (is_null(Yii::$app->user->identity)) {
            return $this->controller->redirect(Url::to(['/site/login']));
        }

        $defaultCompany = Office::find(['default_company'=>1])->asArray()->one();

        return $this->controller->render('obhliadky/add',[
                'default_company' => $defaultCompany,
                'companies' => Office::find()->asArray()->all(),
                'agents' => (new Agent())->getActiveAgentsByOffice($defaultCompany['id']),
                'typy'          => Ucel::getVsetkyUcely(),
                'druhy'         => NehnutelnostDruhy::druhyDoVyhladavania(),
                'stav'          => Konfiguracia::vratZoznam(KonfiguraciaKategorie::KAT_OBJ_STAV),
                'kraje'         => Kraj::krajePreVyhladanie(),
                'okresy'        => Okres::okresyPreVyhladanie(),
                'calendarId'    => Calendar::find()->select(['id'])->where(['=','userId',Yii::$app->user->getId()])
            ]
        );
    }
}