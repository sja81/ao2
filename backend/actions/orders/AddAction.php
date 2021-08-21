<?php
namespace backend\actions\orders;

use common\models\Mesto;
use common\models\Office;
use Yii;
use yii\base\Action;
use yii\helpers\Url;

class AddAction extends Action
{
    public function run()
    {
        if (is_null(Yii::$app->user->identity)) {
            return $this->controller->redirect(Url::to(['/site/login']));
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


        return $this->controller->render('add/index',
            [
                'offices'   => Office::find()->where(['=','status','1'])->all(),
                'default_company'    => Office::find()->where(['=','default_company','1'])->one(),
                'mesto'     => $mesta
            ]
        );
    }
}