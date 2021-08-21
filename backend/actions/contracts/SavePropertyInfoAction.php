<?php
namespace backend\actions\contracts;

use common\models\Nehnutelnost;
use common\models\ZmluvaNehnutelnost;
use Yii;
use yii\base\Action;
use yii\helpers\Url;

class SavePropertyInfoAction extends Action
{
    public function run()
    {
        $request = Yii::$app->request->post('Data');

        $tr = Yii::$app->db->beginTransaction();

        try {
            $nehnutelnost = Nehnutelnost::findOne(['id'=>ZmluvaNehnutelnost::getNehnutelnostId($request['zmluva_id'])]);
            $nehnutelnost->mesto = $request['KU_obec_nazov'];
            $nehnutelnost->stat = $request['krajina'];
            $nehnutelnost->kraj = $request['kraj'];
            $nehnutelnost->okres = $request['KU_okres_nazov'];
            $nehnutelnost->psc = $request['psc'];
            $nehnutelnost->ulica = $request['KU_ulica'];
            $nehnutelnost->supis_cis = $request['supis_cis'];
            $nehnutelnost->list_vlast = $request['list_vlast'];
            $nehnutelnost->orient_cisl = $request['orient_cisl'];
            $nehnutelnost->gps_lat = $request['gps_lat'];
            $nehnutelnost->gps_long = $request['gps_long'];
            $nehnutelnost->cislo_byt = $request['cislo_byt'];
            $nehnutelnost->parc_cislo = $request['parc_cislo'];
            $nehnutelnost->parc_cislo = $request['parc_cislo'];
            $nehnutelnost->kat_uzemie = $request['KU_uzemie_nazov'];
            $nehnutelnost->kat_uzemie_kod = $request['KU_uzemie_kod'];
            $nehnutelnost->obec_kod = $request['KU_obec_kod'];
            $nehnutelnost->okres_kod = $request['KU_okres_kod'];

            $result = $nehnutelnost->save();
            if (!$result) {
                throw new Exception("Chyba pri ukladani nehnutelnosti!");
            }

            $tr->commit();

            $this->controller->redirect(Url::to(['/contracts/new-majitelia','id' => $request['zmluva_id']]));

        } catch (\Exception $ex) {
            $tr->rollBack();
            echo $ex->getMessage();
            echo $ex->getLine();
            exit;
        }
    }
}