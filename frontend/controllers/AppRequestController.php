<?php
namespace frontend\controllers;

use common\models\client\Client;
use common\models\client\ClientContact;
use common\models\client\ClientDetail;
use common\models\client\ClientDocumentFiles;
use common\models\client\ClientDocuments;
use common\models\client\ClientReferal;
use common\models\client\ClientRequest;
use common\models\idcardreader\SlovakIdCardProcessor;
use common\models\sys\SysLog;
use Yii;
use yii\db\Exception;
use yii\db\Expression;
use yii\web\Controller;
use yii\web\Response;

class AppRequestController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'index' => [
                'class' => 'frontend\actions\apprequest\IndexAction'
            ],
            'ajax-save-client-jobs' => [
                'class' => 'frontend\actions\apprequest\SaveClientJobsAction'
            ],
            'ajax-save-client-businesses' => [
                'class' =>  'frontend\actions\apprequest\SaveClientBusinessAction'
            ],
            'ajax-save-client-cashflow' => [
                'class' =>  'frontend\actions\apprequest\SaveClientCashflowAction'
            ]
        ];
    }

    public function actionAjaxSaveClient()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $clientData = Yii::$app->request->post('client_data');
        $clientId = Yii::$app->request->post('client_id');

        $requests = Yii::$app->request->post('reqs');
        $consent = Yii::$app->request->post('clconsent');
        $newsletter = Yii::$app->request->post('clnews');
        $clientRequest = null;
        $clientContact = null;
        $pid = getmypid();
        $tr = Yii::$app->db->beginTransaction();
        try{
            SysLog::WriteInfo($pid,'AppRequestController','Starting to write client data');
            $client = Client::findOne(['id'=>$clientId]);
            if (!$client) {
                $client = new Client();
                $client->save();
            }

            SysLog::WriteInfo($pid,'AppRequestController',"Client ID: ". $client->id);

            foreach ($clientData as $data){
                if ($data['item'] == 'app_src') {
                    $clientRequest = ClientRequest::findOne(['client_id'=>$client->id]);
                    if (!$clientRequest) {
                        $clientRequest = new ClientRequest();
                        $clientRequest->client_id = $client->id;
                    }
                    $clientRequest->source = $data['val'];
                    $clientRequest->save(false);
                }
                if ($data['item'] == 'other_src' && strlen($data['val']) > 0 && !is_null($clientRequest)) {

                    $clientRequest->other_source = $data['val'];
                    $clientRequest->updated_at = new Expression('NOW()');
                    $clientRequest->save(false);
                }
                if ($data['item'] == 'referal_code' && strlen($data['val'])>0) {
                    $clientReferal = ClientReferal::findOne(['client_id'=>$client->id]);
                    if (!($clientReferal)) {
                        $clientReferal = new ClientReferal();
                        $clientReferal->client_id = $client->id;
                    }
                    $clientReferal->referal = $data['val'];
                    $clientReferal->save(false);
                }
                if ($data['item'] == 'call_type' && strlen($data['val'])>0) {
                    $clientRequest->call_type = $data['val'];
                    $clientRequest->updated_at = new Expression('NOW()');
                    $clientRequest->save(false);
                }
                if ($data['item'] == 'call_src' && strlen($data['val'])>0) {
                    $clientRequest->call_source = $data['val'];
                    $clientRequest->updated_at = new Expression('NOW()');
                    $clientRequest->save(false);
                }
                if ($data['item'] == 'client_email') {
                    $client->email = $data['val'];
                    $client->updated_at = new Expression('NOW()');
                    $client->save(false);
                }
                if ($data['item'] == 'client_mobile_area' && strlen($data['val'])>0) {
                    $clientContact = ClientContact::findOne(['client_id'=>$client->id]);
                    if (!$clientContact) {
                        $clientContact = new ClientContact();
                        $clientContact->client_id = $client->id;
                    }
                    $clientContact->mobile_area_code = $data['val'];
                    $clientContact->save(false);
                }
                if ($data['item'] == 'client_mobile' && strlen($data['val'])>0) {
                    $clientContact->mobile = $data['val'];
                    $clientContact->updated_at = new Expression('NOW()');
                    $clientContact->save(false);
                }
                if ($data['item'] == 'client_landline_area' && strlen($data['val'])>0) {
                    $clientContact = ClientContact::findOne(['client_id'=>$client->id]);
                    if (!$clientContact) {
                        $clientContact = new ClientContact();
                        $clientContact->client_id = $client->id;
                    }
                    $clientContact->phone_area_code = $data['val'];
                    $clientContact->save(false);
                }
                if ($data['item'] == 'client_landline' && strlen($data['val'])>0) {
                    $clientContact->phone = $data['val'];
                    $clientContact->updated_at = new Expression('NOW()');
                    $clientContact->save(false);
                }
                if ($data['item'] == 'client_fax_area' && strlen($data['val'])>0) {
                    $clientContact = ClientContact::findOne(['client_id'=>$client->id]);
                    if (!$clientContact) {
                        $clientContact = new ClientContact();
                        $clientContact->client_id = $client->id;
                    }
                    $clientContact->phone_area_code = $data['val'];
                    $clientContact->save(false);
                }
                if ($data['item'] == 'client_fax' && strlen($data['val'])>0) {
                    $clientContact->fax = $data['val'];
                    $clientContact->updated_at = new Expression('NOW()');
                    $clientContact->save(false);
                }
            }
            $tr->commit();
            $client->updateAuthKey();
            $clientRequest->req_data = json_encode($requests);
            $clientRequest->updated_at = new Expression('NOW()');
            $clientRequest->save(false);

            $clientDetail = ClientDetail::findOne(['client_id'=>$client->id]);
            if (!$clientDetail) {
                $clientDetail = new ClientDetail();
                $clientDetail->client_id = $client->id;
            } else {
                $clientDetail->updated_at = new Expression('NOW()');
            }
            $clientDetail->newsletter = $newsletter;
            $clientDetail->consent = $consent;
            $clientDetail->save(false);

        } catch(\Exception $ex) {
            SysLog::WriteError($pid,'AppRequestController',$ex->getMessage(),$ex->getLine());
            $tr->rollBack();
            return ['status'=>'error','message'=>$ex->getMessage()];
        }
        SysLog::WriteInfo($pid,'AppRequestController','Client data written successfuly');
        return ['status'=>'ok','client_id'=>$client->id];
    }

    public function actionAjaxUploadDoc()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $docType = Yii::$app->request->post('doc_type');

        $clientId = Yii::$app->request->post('client_id');
        $orderId = Yii::$app->request->post('order');
        $country = Yii::$app->request->post('country');
        $pid = getmypid();

        if ((int)$clientId  == 0 ) {
            SysLog::WriteError($pid,'AppRequestController','Wrong client ID - method: actionAjaxUploadDoc',483);
            return ['status'=>'error','message'=>'Wrong client ID'];
        }

        $tr = Yii::$app->db->beginTransaction();
        try{
            SysLog::WriteInfo($pid,'AppRequestController','Starting to write client document');
            SysLog::WriteInfo($pid, 'AppRequestController','Client ID: '.$clientId);

            $ocr = new SlovakIdCardProcessor();
            $ocr->pridajPrednuStranu($_FILES['op-predna']['tmp_name']);
            $ocr->pridajZadnuStranu($_FILES['op-zadna']['tmp_name']);
            $result = $ocr->processDocument();

            // open a folder for the client and move the ID card there
            $folder = Yii::getAlias('@webroot')."/../../". Client::getClientMainFolder($clientId);
            if (!file_exists($folder)) {
                mkdir($folder);
            }
            $folder = Yii::getAlias('@webroot')."/../../". Client::getClientDocumentFolder($clientId);
            if (!file_exists($folder)) {
                mkdir($folder);
            }

            $doc = new ClientDocuments();
            $doc->client_id = $clientId;
            $doc->order_id = $orderId;
            $doc->doc_type = $docType;
            $doc->doc_number = $result['doc_number'];
            $doc->doc_issuer = $result['doc_issuer'];
            $doc->doc_country = $country;
            $doc->issue_date = (new \DateTime($result['issue_date']))->format('Y-m-d');
            $doc->validity_date = (new \DateTime($result['validity_date']))->format('Y-m-d');
            $doc->save(false);

            if (is_array($_FILES['op-predna'])) {
                move_uploaded_file($_FILES["op-predna"]["tmp_name"], $folder. '/' . basename($_FILES["op-predna"]["name"]));
                $docFile = new ClientDocumentFiles();
                $docFile->doc_id = $doc->id;
                $docFile->side = 0; /* front */
                $docFile->file = $_FILES['op-predna']['name'];
                $docFile->save(false);
                unset($docFile);
            }
            if (is_array($_FILES['op-zadna'])) {
                move_uploaded_file($_FILES["op-zadna"]["tmp_name"], $folder. '/' . basename($_FILES["op-zadna"]["name"]));
                $docFile = new ClientDocumentFiles();
                $docFile->doc_id = $doc->id;
                $docFile->side = 0; /* front */
                $docFile->file = $_FILES['op-predna']['name'];
                $docFile->save(false);
                unset($docFile);
            }
            $tr->commit();
        }catch(\Exception $ex){
            SysLog::WriteError($pid,'AppRequestController',$ex->getMessage(),$ex->getLine());
            $tr->rollBack();
            return ['status'=>'error','message'=>$ex->getMessage()];
        }

        SysLog::WriteInfo($pid,'AppRequestController','Client data written successfuly');
        return ['status'=>'ok','client_id'=>$clientId, 'result' => $result];
    }

    public function actionAjaxSaveClientAddress()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $clientData = Yii::$app->request->post('client_data');
        $clientId = Yii::$app->request->post('client_id');

        $pid = getmypid();

        if ((int)$clientId  == 0 ) {
            return [
                'status'=>'error',
                'message'=>'Wrong client ID'
            ];
        }

        $tr = Yii::$app->db->beginTransaction();
        try{
            SysLog::WriteInfo($pid,'AppRequestController','Starting to write client address');
            SysLog::WriteInfo($pid, 'AppRequestController','Client ID: '.$clientId);


            $clientContact = ClientContact::findOne(['client_id'=>$clientId]);
            foreach ($clientData as $data){
                if ( strpos($data['item'],'temp_') !== false && $data['val'] == '') {
                    continue;
                }
                $item = $data['item'];
                if (strpos($item,"_from") !== false && strpos($data['val'],'.') !== false) {
                    $clientContact->$item = (new \DateTime($data['val']))->format("Y-m-d");
                } else {
                    $clientContact->$item = $data['val'];
                }
            }
            $clientContact->save(false);
            $tr->commit();
        } catch(Exception $ex) {
            SysLog::WriteError($pid,'AppRequestController',$ex->getMessage(),$ex->getLine());
            $tr->rollBack();
            return [
                'status'=>'error',
                'message'=>$ex->getMessage()
            ];
        }
        SysLog::WriteInfo($pid,'AppRequestController','Client address written successfuly');
        return [
            'status'=>'ok',
            'client_id'=>$clientId,
        ];
    }

    public function actionAjaxSaveFamilyData()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $clientData = Yii::$app->request->post('client_data');
        $clientId = Yii::$app->request->post('client_id');

        $pid = getmypid();
        $tr = Yii::$app->db->beginTransaction();
        try{
            SysLog::WriteInfo($pid,'AppRequestController','Starting to write clients other personal data');
            SysLog::WriteInfo($pid, 'AppRequestController','Client ID: '.$clientId);


            if ((int)$clientId  == 0 ) {
                throw new Exception('Wrong client ID');
            }
            $clientDetail = ClientDetail::findOne(['client_id'=>$clientId]);

            foreach($clientData as $data) {
                $item = $data['item'];
                if ($item == 'living_from') {
                    $clientDetail->$item = (new \DateTime($data['val']))->format('Y-m-d');
                } else {
                    $clientDetail->$item = $data['val'];
                }
            }
            $clientDetail->updated_at = new Expression('NOW()');
            $clientDetail->save(false);
            $tr->commit();
        } catch(Exception $ex) {
            SysLog::WriteError($pid,'AppRequestController',$ex->getMessage(),$ex->getLine());
            $tr->rollBack();
            return [
                'status'=>'error',
                'message'=>$ex->getMessage()
            ];
        }
        SysLog::WriteInfo($pid,'AppRequestController','Client other personal data were written successfuly');
        return [
            'status'=>'ok',
            'client_id'=>$clientId,
        ];

    }

    public function actionAjaxSaveClientOtherPersonalData()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $clientData = Yii::$app->request->post('client_data');
        $clientId = Yii::$app->request->post('client_id');

        $pid = getmypid();
        $tr = Yii::$app->db->beginTransaction();

        try{
            SysLog::WriteInfo($pid,'AppRequestController','Starting to write clients other personal data');
            SysLog::WriteInfo($pid, 'AppRequestController','Client ID: '.$clientId);


            if ((int)$clientId  == 0 ) {
                throw new Exception('Wrong client ID');
            }

            $client = Client::findOne(['id'=>$clientId]);
            $clientDetail = ClientDetail::findOne(['client_id'=>$clientId]);

            foreach ($clientData as $data) {
                $item = $data['item'];
                if ( $item == 'citizenship' and strlen($data['val']) > 0) {
                    $clientDetail->$item = $data['val'];
                }
                if ($item == 'gender' and strlen($data['val']) > 0) {
                    $client->$item = $data['val'];
                }
                if ($item == 'ssn' and strlen($data['val']) > 0) {
                    $client->$item = $data['val'];
                }
                if ($item == 'birth_date' and strlen($data['val']) > 0) {
                    $client->$item = (new \DateTime($data['val']))->format('Y-m-d');
                }
                if ($item == 'birth_place' and strlen($data['val']) > 0) {
                    $client->$item = $data['val'];
                }
                if ($item == 'education' and strlen($data['val']) > 0) {
                    $clientDetail->$item = $data['val'];
                }
            }
            $clientDetail->updated_at = new Expression('NOW()');
            $clientDetail->update(false);
            $client->updated_at = new Expression('NOW()');
            $client->update(false);
            $tr->commit();
            $client->makeReferalCode();
        } catch(Exception $ex) {
            SysLog::WriteError($pid,'AppRequestController',$ex->getMessage(),$ex->getLine());
            $tr->rollBack();
            return [
                'status'=>'error',
                'message'=>$ex->getMessage()
            ];
        }
        SysLog::WriteInfo($pid,'AppRequestController','Client other personal data were written successfuly');
        return [
            'status'=>'ok',
            'client_id'=>$clientId,
        ];
    }

    public function actionAjaxSaveClientDocs()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $clientData = Yii::$app->request->post('client_data');
        $clientId = Yii::$app->request->post('client_id');

        $pid = getmypid();
        $tr = Yii::$app->db->beginTransaction();
        try{
            SysLog::WriteInfo($pid,'AppRequestController','Starting to write client documents');
            SysLog::WriteInfo($pid, 'AppRequestController','Client ID: '.$clientId);

            if ((int)$clientId  == 0 ) {
                throw new Exception('Wrong client ID');
            }
            $docs = [];
            foreach($clientData as $data) {
                $docs[$data['order']-1][$data['item']] = $data['val'];
            }

            for($i=0; $i < count($docs); $i++) {

                $clientDoc = ClientDocuments::findOne(['client_id'=>$clientId,'doc_type'=>$docs[$i]['doc_type']]);
                if ($clientDoc) {
                    $clientDoc->updated_at = new Expression('NOW()');
                } else {
                    $clientDoc = new ClientDocuments();
                }

                $clientDoc->client_id = $clientId;
                $clientDoc->order_id = $i+1;
                $clientDoc->doc_type = $docs[$i]['doc_type'];
                $clientDoc->doc_number = $docs[$i]['doc_number'];
                $clientDoc->doc_issuer = $docs[$i]['doc_issuer'];
                $clientDoc->doc_country = $docs[$i]['doc_country'];
                $clientDoc->issue_date = (new \DateTime($docs[$i]['issue_date']))->format('Y-m-d');
                $clientDoc->validity_date = (new \DateTime($docs[$i]['validity_date']))->format('Y-m-d');

                $clientDoc->save(false);
            }

            $tr->commit();
        } catch(Exception $ex) {
            SysLog::WriteError($pid,'AppRequestController',$ex->getMessage(),$ex->getLine());
            $tr->rollBack();
            return [
                'status'=>'error',
                'message'=>$ex->getMessage()
            ];
        }
        SysLog::WriteInfo($pid,'AppRequestController','Client address written successfuly');
        return [
            'status'=>'ok',
            'client_id'=>$clientId,
        ];

    }

    public function actionAjaxSaveClientData()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $clientData = Yii::$app->request->post('client_data');
        $clientId = Yii::$app->request->post('client_id');

        $pid = getmypid();
        $tr = Yii::$app->db->beginTransaction();

        try{
            SysLog::WriteInfo($pid,'AppRequestController','Starting to write client data');
            SysLog::WriteInfo($pid, 'AppRequestController','Client ID: '.$clientId);


            if ((int)$clientId  == 0 ) {
                throw new Exception('Wrong client ID');
            }

            $client = Client::findOne(['id'=>$clientId]);

            foreach ($clientData as $data){
                if ($data['item'] == 'adegree_before' && strlen($data['val']) > 0) {
                    $client->adegree_before = $data['val'];
                }
                if ($data['item'] == 'adegree_after' && strlen($data['val']) > 0) {
                    $client->adegree_after = $data['val'];
                }
                if ($data['item'] == 'first_name' && strlen($data['val']) > 0) {
                    $client->name_first = $data['val'];
                }
                if ($data['item'] == 'last_name' && strlen($data['val']) > 0) {
                    $client->name_last = $data['val'];
                }
                if ($data['item'] == 'maiden_name' && strlen($data['val']) > 0) {
                    $client->maiden_name = $data['val'];
                }
            }
            $client->save(false);
            $tr->commit();
        }catch(Exception $ex) {
            SysLog::WriteError($pid,'AppRequestController',$ex->getMessage(),$ex->getLine());
            $tr->rollBack();
            return [
                'status'=>'error',
                'message'=>$ex->getMessage()
            ];
        }
        SysLog::WriteInfo($pid,'AppRequestController','Client data written successfuly');
        return [
            'status'=>'ok',
            'client_id'=>$clientId,
        ];
    }



}