<?php
namespace backend\actions\contracts;

use common\models\Nehnutelnost;
use common\models\NehnutelnostNaklady;
use common\models\NehnutelnostZakladneInfo;
use common\models\ZmluvaNehnutelnost;
use Exception;
use Yii;
use yii\base\Action;
use yii\helpers\Url;

class SaveBasicsAction extends Action
{
    public function run()
    {
        $request = Yii::$app->request->post('Data');

        $tr = Yii::$app->db->beginTransaction();

        try {

            $nehnutelnost = Nehnutelnost::findOne(['id'=>ZmluvaNehnutelnost::getNehnutelnostId($request['zmluva_id'])]);
            $request['nehnut_id'] = $nehnutelnost->id;
            unset($nehnutelnost);

            $zakladneInfo = new NehnutelnostZakladneInfo();
            $zakladneInfo->ulozZakladneInformacie($request);

            $nehnutNaklady = new NehnutelnostNaklady();
            $result = $nehnutNaklady->ulozNaklady($request['naklady'], $request['nehnut_id']);

            if (!$result) {
                throw new Exception('Naklady sa nedaju ulozit', 401);
            }
            $tr->commit();

            $this->controller->redirect(Url::to(["/contracts/new-room",'id'=>$request['zmluva_id']]));

        }catch (Exception $ex) {
            $tr->rollBack();
            echo $ex->getMessage();
            echo $ex->getLine();
            exit;
        }
    }
}