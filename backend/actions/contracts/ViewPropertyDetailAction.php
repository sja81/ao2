<?php
namespace backend\actions\contracts;

use common\models\Nehnutelnost;
use common\models\NehnutelnostMiestnosti;
use common\models\NehnutelnostSumar;
use common\models\NehnutelnostZakladneInfo;
use common\models\Zmluva;
use common\models\ZmluvaAgent;
use common\models\ZmluvaCena;
use common\models\ZmluvaNehnutelnost;
use common\models\ZmluvaUcel;
use Yii;
use yii\base\Action;
use yii\helpers\Url;

class ViewPropertyDetailAction  extends Action
{
    public function run(int $id)
    {
        if (is_null(Yii::$app->user->identity)) {
            return $this->controller->redirect(Url::to(['/site/login']));
        }

        $zmluva = Zmluva::findOne(['id'=>$id]);

        $nehnutId = ZmluvaNehnutelnost::getNehnutelnostId($id);
        $sumar = NehnutelnostSumar::find()
            ->select(['description'])
            ->andWhere(['=','status',1])
            ->andWhere(['=','nehnut_id',$nehnutId])
            ->asArray()
            ->one();

        return $this->controller->render('detail',[
            'id_zmluva'     => $zmluva->cislo,
            'sumar'         => !is_null($sumar) ? $sumar['description'] : '',
            'ucel'          => ZmluvaUcel::vratUcel($id),
            'zakladne_info' => NehnutelnostZakladneInfo::vratZakladneInformacie($nehnutId),
            'nehnutelnost'  => Nehnutelnost::findOne(['id'=>$nehnutId]),
            'meno_maklera'  => ZmluvaAgent::vratMenoAgenta($id),
            'miestnosti'    => NehnutelnostMiestnosti::vratMiestnosti($nehnutId),
            'cena'          => ZmluvaCena::vratCenu($id),
        ]);
    }
}