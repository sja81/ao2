<?php
namespace backend\actions\contracts;

use common\models\Nehnutelnost;
use common\models\NehnutelnostZakladneInfo;
use common\models\Zmluva;
use common\models\ZmluvaCena;
use common\models\ZmluvaNehnutelnost;
use common\models\ZmluvaSluzby;
use common\models\ZmluvaSocialneMedia;
use common\models\ZmluvaUcel;
use Yii;
use yii\base\Action;
use yii\helpers\Url;

class SaveOthersAction extends Action
{
    public function run()
    {
        $request = Yii::$app->request->post('Data');

        $tr = Yii::$app->db->beginTransaction();
        try {
            $zmluva = Zmluva::findOne(["id"=>$request['zmluva_id']]);
            $zmluva->pridajUdajeDoZmluvy($request);

            $sluzby = new ZmluvaSluzby();
            $sluzby->pridajSluzby($request);

            $zmluvaUcel = new ZmluvaUcel();
            $zmluvaUcel->pripojUcel($zmluva->id, $request['ucel']);

            $ceny = new ZmluvaCena();
            $ceny->pridajCeny($request);

            $socmedia = new ZmluvaSocialneMedia();
            $socmedia->pridajSocialneMedia($request);

            $nehnutId = ZmluvaNehnutelnost::getNehnutelnostId($request['zmluva_id']);
            $zakladneInfo = NehnutelnostZakladneInfo::findOne(['nehnut_id'=>$nehnutId]);
            $zakladneInfo->updatePodmienky($request);

            $tr->commit();

            $this->controller->redirect(Url::to(["/contracts/new-summary",'id'=>$request['zmluva_id']]));

        } catch (Exception $ex) {
            $tr->rollBack();
            echo $ex->getMessage();
            echo $ex->getLine();
            exit;
        }
    }
}