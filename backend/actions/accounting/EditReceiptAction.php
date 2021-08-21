<?php
namespace backend\actions\accounting;

use Yii;
use common\models\Mesto;
use common\models\Office;
use common\models\Stat;
use yii\base\Action;
use yii\helpers\Url;

class EditReceiptAction extends Action
{
    public function run()
    {
        if (is_null(Yii::$app->user->identity)) {
            return $this->controller->redirect(Url::to(['/site/login']));
        }

        $defaultOffice = Office::findOne(['default_company',1]);

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
            'default_office'    => $defaultOffice,
            'mesto'             => $mesta,
            'office'    => Office::find()->andWhere(['=','status',1])->asArray()->all(),
            'currencies' => Stat::find()->select(['mena'])->andWhere(['=','status',1])->distinct()->all(),
        ]);
    }
}