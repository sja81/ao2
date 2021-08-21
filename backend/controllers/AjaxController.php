<?php
namespace backend\controllers;

use common\models\idcardreader\SlovakIdCardProcessor;
use common\models\Office;
use common\models\OzoneSettings;
use common\models\Stock;
use common\models\Zmluva;
use Yii;
use yii\web\Controller;
use yii\web\Response;

class AjaxController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionGetCities(string $q)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $list = Yii::$app->db->createCommand("
            SELECT 
                m.id, 
                CONCAT(m.nazov_obce,' (okr. ',o.name,' / ',s.`iso_kod`,')') AS obec 
            FROM 
                mesto m 
            JOIN 
                okres o ON m.okres_id=o.id 
            JOIN
                stat s ON m.stat_id=s.id
            WHERE 
                m.nazov_obce LIKE '%{$q}%'
        ")->queryAll();

        $result = [];
        foreach($list as $item) {
            $result[$item['id']] = $item['obec'];
        }

        return ['status'=>'ok','items'=>$result];

    }

    public function actionNahrajOp()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $result = "";
        try{
            $ocr = new SlovakIdCardProcessor();
            $ocr->pridajPrednuStranu($_FILES['op-predna']['tmp_name']);
            $ocr->pridajZadnuStranu($_FILES['op-zadna']['tmp_name']);
            $result = $ocr->process();
        }catch(\Exception $ex) {
            return ['status'=>'error','message'=>$ex->getMessage()];
        }

        $poradie = Yii::$app->request->post('poradie');
        $zmluvaId = Yii::$app->request->post('zmluva_id');

        $zmluva = Zmluva::findOne(['id'=>$zmluvaId]);

        if (!file_exists(Yii::getAlias('@webroot')."/../docstore/".$zmluva->cislo."/op")) {
            mkdir(Yii::getAlias('@webroot')."/../docstore/".$zmluva->cislo."/op");
        }

        if (!file_exists(Yii::getAlias('@webroot')."/../docstore/".$zmluva->cislo."/op/{$poradie}")) {
            mkdir(Yii::getAlias('@webroot')."/../docstore/".$zmluva->cislo."/op/{$poradie}");
        }

        $path = Yii::getAlias('@webroot')."/../docstore/".$zmluva->cislo."/op/{$poradie}/";
        unset($zmluva);

        move_uploaded_file($_FILES['op-predna']['tmp_name'],$path."predna_".$_FILES['op-predna']['name']);
        move_uploaded_file($_FILES['op-zadna']['tmp_name'],$path."zadna_".$_FILES['op-zadna']['name']);



        return ['status'=>'ok','items'=>$result];
    }

    public function actionGetOffice()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $id = Yii::$app->request->post('id');
        $office = Office::findOne(['id'=>$id]);
        if (!$office) {
            return [];
        }

        return [
            'kanc-address'          => $office->address,
            'kanc-zip'              => $office->zip,
            'kanc-town'             => $office->town,
            'kanc-country'          => $office->country,
            'kanc-contact-person'   => $office->contact_person,
            'kanc-email'            => $office->email,
            'kanc-phone'            => $office->phone,
            'kanc-web'              => $office->web,
            'kanc-bank'             => $office->bank,
            'kanc-iban'             => $office->iban,
            'kanc-ico'              => $office->ico,
            'kanc-dic'              => $office->dic,
            'kanc-icdph'            => $office->icdph,
            'kanc-registered'       => $office->registered,
            'kanc-default-comp'     => (int) $office->default_company,
            'kanc-vat-payer'        => (int) $office->vat_payer
        ];
    }

    public function actionSaveOffice()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $data = Yii::$app->request->post();
        $office = Office::findOne(['id'=>$data['id']]);
        if (!$office) {
            $office = new Office();
        }
        foreach($data as $key=>$val) {
            if ($key == 'id') {
                continue;
            }
            $office->$key = $val;
        }
        $result = $office->save();
        if (!$result) {
            return ['error'=>'Office was not savef'];
        }
        return ['status'=>'ok'];
    }

    public function actionSaveMaterial()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $data = Yii::$app->request->post('DlgData');
        $stock = new Stock();
        $stock->attributes = $data;
        $result = $stock->save();

        if (!$result) {
            return ['error'=>'Karta nebola ulozena!'];
        }

        // there is no folder ddd in dockstore
        if (!file_exists(Yii::getAlias('@webroot')."/../docstore/ddd-materials")) {
            mkdir(Yii::getAlias('@webroot')."/../docstore/ddd-materials");
        }

        $path = Yii::getAlias('@webroot')."/../docstore/ddd-materials/{$data['kod']}";

        if (!file_exists($path)) {
            mkdir($path);
        }

        move_uploaded_file($_FILES['datasheet']['tmp_name'],$path."/".$_FILES['datasheet']['name']);

        $resp = $this->render('/ddd-services/settings/setting-row',$stock);

        return ['status'=>'ok','result'=>$resp];
    }

    public function actionSaveOzoneSettings()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $data = Yii::$app->request->post('OzoneData');
        foreach ($data as $key => $item) {

            $toUpdate = false;
            $elem = OzoneSettings::findOne(['field_name'=>$key]);

            if ($elem) {
                if ($elem->field_value != $item['value']) {
                    $elem->field_value = $item['value'];
                    $toUpdate = true;
                }
                if ($elem->field_comment != $item['comment']) {
                    $elem->field_comment = $item['comment'];
                    $toUpdate = true;
                }
                if ($toUpdate) {
                    $elem->update();
                }
                unset($elem);
            }
        }

        return ['status'=>'ok'];
    }

    public function actionImageUploader()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $dirName = Yii::getAlias('@backend')."/web/assets/media/";
        move_uploaded_file($_FILES['file']['tmp_name'],$dirName.$_FILES['file']['name']);
        return [
            'status'    => 'ok',
            'url'       => 'https://'.$_SERVER['HTTP_HOST'].'/backend/web/assets/media/'.$_FILES['file']['name']
        ];
    }

}