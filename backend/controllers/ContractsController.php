<?php
namespace backend\controllers;

use common\models\AcademicDegrees;
use common\models\Customer;
use common\models\Documents;
use common\models\documents\DocumentFactory;
use common\models\NehnutelnostDokumenty;
use common\models\NehnutelnostDruhy;
use common\models\NehnutelnostLv;
use common\models\NehnutelnostObrazok;
use common\models\Office;
use common\models\Operator;
use common\models\reader\BytyLVReader;
use common\models\reader\DomyLVReader;
use common\models\Stat;
use common\models\Supplier;
use common\models\Zmluva;
use common\models\ZmluvaZakaznik;
use Smalot\PdfParser\Parser;
use Yii;
use yii\helpers\Url;
use yii\web\Response;
use yii\web\Controller;


class ContractsController extends Controller
{

    public function beforeAction($action) {
        if ($action->id == 'upload-image') {
            $this->enableCsrfValidation = false;
        }
        if ($action->id == 'upload-lv') {
            $this->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'index' => [
                'class' => 'backend\actions\contracts\IndexAction'
            ],
            'new' => [
                'class' => 'backend\actions\contracts\NewContractAction'
            ],
            'save-makler-nehnutelnost' => [
                'class' => 'backend\actions\contracts\SaveBasicInfoAction'
            ],
            'edit'  => [
                'class' => 'backend\actions\contracts\EditContractAction'
            ],
            'new-majitelia' => [
                'class' => 'backend\actions\contracts\NewMajiteliaAction'
            ],
            'save-majitelia'    => [
                'class' => 'backend\actions\contracts\SaveMajiteliaAction'
            ],
            'basic-info'    => [
                'class' => 'backend\actions\contracts\BasicInfoAction'
            ],
            'save-basics'   => [
                'class' =>  'backend\actions\contracts\SaveBasicsAction'
            ],
            'new-room' => [
                'class' => 'backend\actions\contracts\NewRoomAction'
            ],
            'save-room' => [
                'class' => 'backend\actions\contracts\SaveRoomAction'
            ],
            'new-kitchen' => [
                'class' => 'backend\actions\contracts\NewKitchenAction'
            ],
            'save-kitchen'  => [
                'class' => 'backend\actions\contracts\SaveKitchenAction'
            ],
            'new-bath'  => [
                'class' => 'backend\actions\contracts\NewBathAction'
            ],
            'save-bath' => [
                'class' => 'backend\actions\contracts\SaveBathAction'
            ],
            'new-others' => [
                'class' => 'backend\actions\contracts\NewOthersAction'
            ],
            'save-others' => [
                'class' => 'backend\actions\contracts\SaveOthersAction'
            ],
            'new-summary' => [
                'class' => 'backend\actions\contracts\NewSummaryAction'
            ],
            'save-summary' => [
                'class' => 'backend\actions\contracts\SaveSummaryAction'
            ],
            'documents' => [
                'class' => 'backend\actions\contracts\DocumentsAction'
            ],
            'property-info' => [
                'class' => 'backend\actions\contracts\PropertyInfoAction'
            ],
            'save-property-info' => [
                'class' => 'backend\actions\contracts\SavePropertyInfoAction'
            ],
            'view-property' => [
                'class' => 'backend\actions\contracts\ViewPropertyDetailAction'
            ],
            'obhliadky' => [
                'class' => 'backend\actions\contracts\ObhliadkyAction'
            ],
            'add-visit' => [
                'class' =>  'backend\actions\contracts\AddVisitAction'
            ],
            'accept-protocol' => [
                'class' =>  'backend\actions\contracts\AcceptanceProtocolAction'
            ]
        ];
    }

    public function actionAdd()
    {
        return $this->render('add/index');
    }

    /*public function actionAjaxApprove(int $to_approve)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        (new Contract())->updateContractStatus($to_approve, ContractEntity::APPROVED);
        return ['status'=>'ok'];
    }*/

    public function actionAjaxGetObec($q)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $list = Yii::$app->db->createCommand("
            SELECT 
                m.id, 
                CONCAT(if(m.psc='',0,m.psc),'-',m.nazov_obce,'-okr. ',o.name) AS obec 
            FROM 
                mesto m 
            JOIN 
                okres o ON m.okres_id=o.id 
            WHERE 
                m.nazov_obce LIKE '%{$q}%'
        ")->queryAll();

        $result = [];
        foreach($list as $item) {
            $result[$item['id']] = $item['obec'];
        }

        return ['status'=>'ok','items'=>$result];
    }

    public function actionAjaxGetObecDetail($tid)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $details = Yii::$app->db->createCommand("
            SELECT
                m.id,
                m.nazov_obce, 
                IFNULL(m.KU_kod_obce,0) AS kod_obce,
                IF(m.psc='',0,m.psc) AS psc,
                IFNULL(m.KU_nazov,'') AS KU_nazov,
                IFNULL(m.KU_kod,0) AS KU_kod,
                o.`name` AS okres,
                o.kod AS okres_kod,
                k.`name` AS kraj,
                s.`name` AS krajina
            FROM
                mesto m
            JOIN
                okres o ON m.okres_id = o.id
            JOIN
                kraj k ON m.kraj_id = k.id
            JOIN
                stat s ON s.id=k.country_id
            WHERE
                m.id=:tid
        ")->bindValue(':tid', $tid)->queryOne();

        return ['status'=>'ok','details'=>$details];
    }

    public function actionAjaxGetPsc($q)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $list = Yii::$app->db->createCommand("
            SELECT 
                mesto.id, 
                CONCAT(if(mesto.psc='',0,mesto.psc),'-',mesto.nazov_obce,'-okr. ',okres.name) AS obec 
            FROM 
                mesto 
            JOIN 
                okres ON mesto.okres_id=okres.id 
            WHERE 
                mesto.psc LIKE '%{$q}%'
        ")->queryAll();

        $result = [];
        foreach($list as $item) {
            $result[$item['id']] = $item['obec'];
        }

        return ['status'=>'ok','items'=>$result];

    }

    public function actionAjaxGetClients($q)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $sql = "SELECT 
                    c.id,
                    CONCAT(name_first,' ',name_last,' - ',rodne_cislo) AS klient
                FROM 
                    customer c
                WHERE 
                    name_last LIKE '%{$q}%'";
        $items = Yii::$app->db->createCommand($sql)->queryAll();

        $result = [];
        foreach($items as $item) {
            $result[$item['id']] = $item['klient'];
        }

        return ['status'=>'ok','items'=>$result];
    }

    public function actionAjaxGetClient($uid)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $details = Yii::$app->db->createCommand("
            SELECT 
                 ac_deg_before,
                 ac_deg_after,   
              	 name_first, 
				 name_last, 
				 adresa,
				 town_id,
				 zip,
				 email, 
				 icdph, 
				 ico, 
				 rodne_cislo, 
				 typ_zakaznika, 
				 dic, 
				 gender, 
				 phone, 
				 obchodne_meno,
				 birth_date,
				 m2.nazov_obce AS nazov_obce,
				 rodne_priezvisko
            from 
              customer c
            join    
              mesto m2 on m2.id=c.town_id   
            where 
              c.id=:id
        ")->bindValue(":id",$uid)->queryOne();

        return ['status'=>'ok','details'=>$details];
    }

    /*public function ajaxChangeStatus(int $to_change)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return ['status'=>'ok'];
    }*/

    public function actionAjaxGenDocs()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $request = Yii::$app->request->post();
        $docs = json_decode($request['docs'],true);
        $result = [];

        $zmluva = Zmluva::findOne(['cislo'=>$request['num']]);
        $zmluva->vytvorAdresare();
        unset($zmluva);

        try{
            foreach($docs as $item) {
                $doc = DocumentFactory::getDocument($item['doc']);
                if (isset($item['firma']) && (int)$item['firma'] >0){
                    $doc->setOffice((int)$item['firma']);
                }
                $doc->setPoradie($item['poradie']);
                $doc->setContractNumber($request['num']);
                $doc->setPodpisMiesto($item['podpis']);
                $doc->setDate($item['datum']);
                $doc->create();
                $result[$item['doc']][$item['poradie']-1] = Yii::getAlias('@web')."/docstore/".$request['num'].'/'.$doc->getFileName();
                unset($doc);
            }
        } catch (\Throwable $ex) {
            throw $ex;
        }
        return ['status'=>'ok','result'=>$result];
    }

    public function actionVratKategorie($kat)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $druhy = NehnutelnostDruhy::getDruhy($kat);
        $response = ['status'=>'ok','items'=> $druhy];
        return $response;
    }

    public function actionUploadImage()
    {
        $zmluva = Zmluva::findOne(['id'=>$_REQUEST['zmluva_id']]);

        if (!$zmluva) {
            return json_encode(["error" => "Zadali ste neexistujúci identifikátor inzerátu!"]);
        }

        $obrazok = new NehnutelnostObrazok();
        $obrazok->zmluva_id = $zmluva->id;
        $obrazok->zmluva_cislo = $zmluva->cislo;
        $obrazok->miestnost_id = $_REQUEST['miestnost_id'];
        $obrazok->pozicia = 1;
        $obrazok->obrazok = $_FILES['qqfile']['name'];
        $obrazok->status = 1;

        $result = $obrazok->save();

        if (!$result) {
            $obrazok->delete();
            return json_encode(["error","Súbor nebol uložený"]);
        }

        $uploadDir = $this->getUploadDir()."/{$zmluva->cislo}/images/";
        $status = move_uploaded_file($_FILES['qqfile']['tmp_name'],$uploadDir.$_FILES['qqfile']['name']);

        if (!$status) {
            $obrazok->delete();
            return json_encode(["error","Súbor nebol uložený"]);
        }

        return json_encode(["success"=>true]);
    }

    public function actionUploadLv()
    {
        $zmluva = Zmluva::findOne(['cislo'=>$_REQUEST['cislo']]);

        if (!$zmluva) {
            return json_encode(["error" => "Zadali ste neexistujúci identifikátor inzerátu!"]);
        }

        $uploadDir = Yii::getAlias('@webroot')."/../docstore/{$zmluva->cislo}/";

        if (!file_exists($uploadDir)) {
            $zmluva->vytvorAdresare();
        }

        $docName = $uploadDir.uniqid()."_".$_FILES['qqfile']['name'];

        $lv = new NehnutelnostDokumenty();
        $lv->zmluva_id = $zmluva->id;
        $lv->zmluva_cislo = $_REQUEST['cislo'];
        $lv->dokument = $docName;
        $lv->dokument_typ = "LV";
        $lv->status = 1;
        $lv->uploaded_at = (new \DateTimeImmutable('now'))->format('Y-m-d H:i:s');
        $lv->uploaded_by = Yii::$app->user->identity->id;

        $result = $lv->save();

        if (!$result) {
            $lv->delete();
            return json_encode(["error","Súbor nebol uložený"]);
        }


        $status = move_uploaded_file($_FILES['qqfile']['tmp_name'],$docName);

        if (!$status) {
            $lv->status=0;
            $lv->save();
            return json_encode(["error","Súbor nebol uložený"]);
        }


        $parser = new Parser();
        $pdf = $parser->parseFile($docName);

        $texts = [];

        foreach ($pdf->getPages() as $page) {
            $texts = array_merge($texts,$page->getTextArray());
        }

        $lvReader = null;
        $template = "";
        switch($_REQUEST['kategoria']) {
            case 1:
                {
                    $lvReader = new BytyLVReader($texts);
                    $template = "identifikovany-majitelia-byt";
                }
                break;
            case 2:
                {
                    $lvReader = new DomyLVReader($texts);
                    $template = "identifikovany-majitelia-dom";
                }
                break;
        }

        $result = $lvReader->process();

        if (!$result) {
            $lv->status=0;
            $lv->save();
            return json_encode(["error","Chyba pri citani LV"]);
        }

        $result = $lvReader->getResult();

        if (!is_array($result)) {
            $lv->status=0;
            $lv->save();
            return json_encode(["error","Chyba pri citani LV - vysledok nie je pole!"]);
        }

        $lvdata = new NehnutelnostLv();
        $lvdata->dok_id = $lv->id;
        $lvdata->data = json_encode($result);
        $lvdata->status=1;
        $lvdata->created_at = (new \DateTimeImmutable('now'))->format("Y-m-d H:i:s");
        $lvdata->created_by = Yii::$app->user->identity->id;
        $lvdata->save();

        $tableResult = $this->renderPartial($template, ['majitelia' => $result]);

        return json_encode(["success"=>true,'items'=>$tableResult]);
    }

    private function getUploadDir()
    {
        return Yii::getAlias('@webroot')."/../../frontend/web/content";
    }

    public function actionZmazLv()
    {
        $sql = "
            update nehnut_dokumenty set status=0 where zmluva_cislo={$_REQUEST['cislo']}
        ";
        Yii::$app->db->createCommand($sql)->execute();
        return json_encode(["success"=>true,'item'=>$this->renderPartial('majitelia-prazdne')]);
    }

    public function actionContractDone()
    {
        unset($_COOKIE['zmluva-cislo']);
        unset($_COOKIE['cislo_bytu']);
        unset($_COOKIE['krok']);

        $this->redirect(Url::to(['/contracts']));
        Yii::$app->end();
    }

    public function actionEditDocuments(int $id)
    {
        if (is_null(Yii::$app->user->identity)) {
            return $this->redirect(Url::to(['/site/login']));
        }

        $predajcovia = ZmluvaZakaznik::find()
            ->select(['customer.id','customer.name_first','customer.name_last','customer.id_card','customer.ssn','customer.maiden_name'])
            ->innerJoin('customer','customer.id=zmluva_zakaznik.zakaznik_id')
            ->andWhere(['=','zakaznik_typ',Customer::PREDAJCA])
            ->andWhere(['=','zmluva_id',$id])
            ->asArray()
            ->all();
        $kupujuci = ZmluvaZakaznik::find()
            ->select(['customer.id','customer.name_first','customer.name_last','customer.id_card','customer.ssn','customer.maiden_name'])
            ->innerJoin('customer','customer.id=zmluva_zakaznik.zakaznik_id')
            ->andWhere(['=','zakaznik_typ',Customer::KUPUJUCI])
            ->andWhere(['=','zmluva_id',$id])
            ->asArray()
            ->all();

        $companies = [];
        if (isset(Yii::$app->user->identity) && Yii::$app->user->identity->hasRole('admin')) {
            $companies = Office::findAll(['status'=>1]);
        }

        $documents = new Documents();
        $degrees = new AcademicDegrees();
        return $this->render('documents',[
            'predajcovia'   => $predajcovia,
            'kupujuci'  => $kupujuci,
            'dokumenty' =>  $documents->getDocumentsByPropertyCategory($id),
            'chybajuce_dokumenty' => $documents->getMissingDocuments($id),
            'contract'  =>  Zmluva::findOne(['id'=>$id]),
            'dodavatel_vody' => Supplier::findAll(['category'=>Supplier::WATER]),
            'dodavatel_elektriny' => Supplier::findAll(['category'=>Supplier::ELECTRICITY]),
            'dodavatel_plynu' => Supplier::findAll(['category'=>Supplier::GAS]),
            'olo' => Supplier::findAll(['category'=>Supplier::WASTE]),
            'dodavatel_tv' => Supplier::findAll(['category'=>Supplier::TV]),
            'dodavatel_telefon' => Supplier::findAll(['category'=>Supplier::PHONE]),
            'companies' => $companies,
            'titul_pred'    => $degrees->getTitulPredMenom(),
            'titul_za'      => $degrees->getTitulZaMenom(),
            'predvolby' => Stat::getPredvolby(),
            'uto'       => Operator::getUTO(Stat::SLOVAKIA)
        ]);
    }

    public function actionAjaxGetTownData()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $term = Yii::$app->request->get('term');
        $townList = Yii::$app->db->createCommand("select id, nazov_obce as label, nazov_obce as `value` from mesto where nazov_obce like '%{$term}%'")->queryAll();
        return $townList;
    }

}
