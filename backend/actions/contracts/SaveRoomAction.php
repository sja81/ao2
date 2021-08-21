<?php
namespace backend\actions\contracts;

use common\models\KonfiguraciaScenare;
use common\models\Nehnutelnost;
use common\models\NehnutelnostMiestnosti;
use common\models\ZmluvaNehnutelnost;
use Yii;
use yii\base\Action;
use yii\helpers\Url;

class SaveRoomAction extends Action
{
    public function run()
    {
        $request = Yii::$app->request->post('Data');

        $tr = Yii::$app->db->beginTransaction();

        try {

            $zmluvaMehnutelnost = ZmluvaNehnutelnost::find()->select('nehnut_id')->where(['=','zmluva_id',$request['zmluva_id']])->one();
            $nehnutId = $zmluvaMehnutelnost->nehnut_id;

            foreach ($request['izba'] as $item) {
                $miestnosti = new NehnutelnostMiestnosti();
                $miestnosti->pridajMiestnost($item, $nehnutId);
            }

            $tr->commit();

            $this->controller->redirect(Url::to(["/contracts/new-kitchen",'id'=>$request['zmluva_id']]));

        }catch(\Exception $ex) {
            $tr->rollBack();
            echo $ex->getMessage();
            echo $ex->getLine();
            exit;
        } finally {
            unset($miestnosti);
            unset($zmluvaMehnutelnost);
            unset($nehnutelnost);
        }
    }
}