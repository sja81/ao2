<?php
namespace backend\actions\configs;

use common\models\FinancialInstitution;
use common\models\Jazyk;
use common\models\Kraj;
use common\models\Office;
use common\models\Okres;
use common\models\Operator;
use common\models\Stat;
use common\models\Supplier;
use Yii;
use yii\base\Action;
use yii\helpers\Url;

class IndexAction extends Action
{
    public function run()
    {
        if (is_null(Yii::$app->user->identity)) {
            return $this->controller->redirect(Url::to(['/site/login']));
        }

        return $this->controller->render('index',[
            'kraje' =>  Kraj::find()->asArray()->all(),
            'jazyky'    => Jazyk::find()->asArray()->all(),
            'dodavatelia'   => Supplier::find()->asArray()->all(),
            'kancelarie'    => Office::find()->asArray()->all(),
            'okresy'        => Okres::find()->asArray()->all(),
            'staty'         =>  Stat::find()->asArray()->all(),
            'operatory'     => Operator::find()->asArray()->all(),
            'banky'         => (new FinancialInstitution())->getAllActiveBanks()
        ]);
    }
}