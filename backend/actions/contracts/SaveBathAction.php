<?php
namespace backend\actions\contracts;

use common\models\KonfiguraciaScenare;
use common\models\Nehnutelnost;
use common\models\NehnutelnostKupelna;
use common\models\ZmluvaNehnutelnost;
use Yii;
use yii\base\Action;
use yii\helpers\Url;

class SaveBathAction extends Action
{
    public function run()
    {
        $request = Yii::$app->request->post('Data');

        $tr = Yii::$app->db->beginTransaction();

        try {

            $zmluvaMehnutelnost = ZmluvaNehnutelnost::find()->select('nehnut_id')->where(['=','zmluva_id',$request['zmluva_id']])->one();
            $nehnutId = $zmluvaMehnutelnost->nehnut_id;

            $kupelna = new NehnutelnostKupelna();

            foreach ($request['kupelna'] as $item) {
                $kupelna->pridajKupelnu($item, $nehnutId);
            }

            $tr->commit();

            $this->controller->redirect(Url::to(["/contracts/new-others",'id'=>$request['zmluva_id']]));

        }catch (\Exception $ex) {
            $tr->rollBack();
            echo $ex->getMessage();
            echo $ex->getLine();
            exit;
        }
    }
}