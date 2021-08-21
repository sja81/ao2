<?php
namespace backend\actions\contracts;

use common\models\Nehnutelnost;
use common\models\Zmluva;
use common\models\ZmluvaAgent;
use common\models\ZmluvaNehnutelnost;
use Yii;
use yii\base\Action;
use yii\helpers\Url;
use yii\web\Cookie;

class SaveBasicInfoAction extends Action
{
    public function run()
    {
        $request = Yii::$app->request->post('Data');

        $tr = Yii::$app->db->beginTransaction();

        $zmluva = Zmluva::findOne(['id'=>$request['zmluva_id']]);

        try {

            $property = new Nehnutelnost();
            $property->created_by = Yii::$app->user->identity->id;
            $property->druh_nehnut = $request['druh_nehnut'];
            $property->kategoria = $request['kategoria'];
            $property->save();

            $zmluvaNehnut = new ZmluvaNehnutelnost();
            $zmluvaNehnut->zmluva_id = (int)$zmluva->id;
            $zmluvaNehnut->nehnut_id = (int)$property->id;
            $result = $zmluvaNehnut->save();

            if (!$result) {
                throw new \Exception('Nemozem ulozit prepojenie medzi nehnutelnostou a zmluvou!', 401);
            }

            $zmluvaAgent = new ZmluvaAgent();
            $zmluvaAgent->zmluva_id = (int)$zmluva->id;
            $zmluvaAgent->agent_id = (int)$request['agent']['id'];
            $zmluvaAgent->comission = (int)$request['agent']['comission'];
            $zmluvaAgent->status = 1;
            $result = $zmluvaAgent->save();

            if (!$result) {
                throw new \Exception('Nemozem ulozit prepojenie medzi agentom a zmluvou!', 401);
            }

            $tr->commit();

            // zvoleny byt
            Yii::$app->response->cookies->add(new Cookie(['name'=>'cislo_bytu','value'=>$request['majitel']]));

            $this->controller->redirect(Url::to(['/contracts/property-info','id' => $zmluva->id]));

        } catch (\Exception $ex) {
            $tr->rollBack();
            echo $ex->getMessage();
            echo $ex->getLine();
            exit;
        }


    }
}