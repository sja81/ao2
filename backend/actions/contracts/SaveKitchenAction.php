<?php
namespace backend\actions\contracts;

use common\models\KonfiguraciaScenare;
use common\models\Nehnutelnost;
use common\models\NehnutelnostKuchyna;
use common\models\ZmluvaNehnutelnost;
use common\models\Znacky;
use Yii;
use yii\base\Action;
use yii\helpers\Url;

class SaveKitchenAction extends Action
{
    public function run()
    {
        $request = Yii::$app->request->post('Data');

        $tr = Yii::$app->db->beginTransaction();

        try {

            $zmluvaMehnutelnost = ZmluvaNehnutelnost::find()->select('nehnut_id')->where(['=','zmluva_id',$request['zmluva_id']])->one();
            $nehnutId = $zmluvaMehnutelnost->nehnut_id;

            $kuchyna = new NehnutelnostKuchyna();

            foreach ($request['kuchyna'] as $item) {
                $kuchyna->pridajKuchynu($item, $nehnutId);
            }

            $tr->commit();

            $this->controller->redirect(Url::to(["/contracts/new-bath",'id'=>$request['zmluva_id']]));

        }catch (\Exception $ex) {
            $tr->rollBack();
            echo $ex->getMessage();
            echo $ex->getLine();
            exit;
        }
    }
}