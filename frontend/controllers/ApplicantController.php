<?php
namespace frontend\controllers;

use common\models\AcademicDegrees;
use common\models\Applications;
use common\models\Jazyk;
use common\models\OtherKnowledge;
use common\models\Stat;
use common\models\uchadzac\Uchadzac;
use common\models\uchadzac\UchadzacJazyk;
use common\models\uchadzac\UchadzacOstatne;
use common\models\uchadzac\UchadzacPozicia;
use common\models\uchadzac\UchadzacVzdelanie;
use common\models\uchadzac\UchadzacVzdelanieKurzSkola;
use common\models\uchadzac\UchadzacZamestnanie;
use common\models\uchadzac\UchadzacZamestnaniePolozky;
use common\models\uchadzac\UchadzacZnalosti;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;
use common\models\uchadzac\UchadzacDoc;

class ApplicantController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'dev-test' => [
                'class' => 'frontend\actions\applicant\DevTestAction'
            ],
            'thank-you' => [
                'class' => 'frontend\actions\applicant\ThankYouAction'
            ],
            'writting-test' => [
                'class' => 'frontend\actions\applicant\WrittingTestAction'
            ],
            'video-test' => [
                'class' => 'frontend\actions\applicant\VideoTestAction'
            ]
        ];
    }

    public function actionIndex()
    {
        $degrees = new AcademicDegrees();
        return $this->render('index',[
            'titul_pred'    => $degrees->getTitulPredMenom(),
            'titul_za'      => $degrees->getTitulZaMenom(),
            'staty'         => Stat::find()->where(['=','status',1])->all(),
            'jazyk'         => Jazyk::find()->asArray()->all(),
            'jobs'          => Applications::find()->where(['=','visible',1])->asArray()->all(),
            'other_know'    => OtherKnowledge::find()->where(['=','status',1])->asArray()->all()
        ]);
    }

    public function actionAjaxMestoDetail()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $tid = Yii::$app->request->post('tid');

        $details = Yii::$app->db->createCommand("
            SELECT
                m.id,
                m.nazov_obce, 
                IF(m.psc='',0,m.psc) AS psc,
                s.`name` AS krajina
            FROM
                mesto m
            JOIN
                stat s ON s.id=m.stat_id
            WHERE
                m.id=:tid
        ")->bindValue(':tid', $tid)->queryOne();

        return ['status'=>'ok','details'=>$details];
    }

    public function actionAjaxMesto()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $q = Yii::$app->request->post('q');
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

    public function actionAjaxOsad()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $osad = json_decode(Yii::$app->request->post('osad'),true);
        $applicantId = (int)Yii::$app->request->post('applicant_id');
        $applicant = Uchadzac::findOne(['id'=>$applicantId]);
        if (!$applicant) {
            $applicant = new Uchadzac();
        }

        $tr = \Yii::$app->db->beginTransaction();

        try{
            foreach($osad as $key => $item) {
                if (in_array($key,['pozicia_id','adv_source'])) {
                    continue;
                }
                $applicant->$key = $item;
            }
            $applicant->save();

            $pozicia = UchadzacPozicia::findOne(['uchadzac_id',$applicant->id]);
            if (!$pozicia) {
                $pozicia = new UchadzacPozicia();
                $pozicia->uchadzac_id = $applicant->id;
                $pozicia->status = UchadzacPozicia::PENDING;
            }
            $pozicia->pozicia_id = $osad['pozicia_id'];
            $pozicia->adv_source = $osad['adv_source'];
            $pozicia->save();
            $tr->commit();
            $result = [
                'status'    => 'ok',
                'applicant_id'  => $applicant->id
            ];
        }catch(\Exception $e) {
            $result = [
                'status' => 'error',
                'msg'   => $e->getMessage()
            ];
            $tr->rollBack();
        }
        return $result;
    }

    public function actionAjaxVzde()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $vzde = json_decode(Yii::$app->request->post('vzde'),true);
        $applicantId = (int)Yii::$app->request->post('applicant_id');

        $result = [
            'status' => 'ok',
            'applicant_id' => $applicantId
        ];

        $applicant = $this->checkApplicant($applicantId);

        if ($applicant != '') {
            $result = [
                'status' => 'error',
                'msg'   => $applicant,
                'code'  => -100
            ];
        } else {
            $tr = \Yii::$app->db->beginTransaction();
            if (!$this->ulozVzdelanie($applicantId, $vzde)) {
                $result = [
                    'status' => 'error',
                    'msg' => 'Uchádzač sa nenachádze v databáze',
                    'code' => -101
                ];
            }

            if (!$this->ulozSkola($applicantId, $vzde, 'vysoka',$error)) {
                $result = [
                    'status' => 'error',
                    'msg' => __FILE__ . "\n" . $error,
                    'code' => -101
                ];
            }
            if (!$this->ulozSkola($applicantId, $vzde, 'stredna',$error)) {
                $result = [
                    'status' => 'error',
                    'msg' => __FILE__ . "\n" . $error,
                    'code' => -102
                ];
            }
            if (!$this->ulozKurz($applicantId, $vzde, $error)) {
                $result = [
                    'status' => 'error',
                    'msg' => __FILE__ . "\n" . $error,
                    'code' => -103
                ];
            }
            if ($result['status'] == 'ok') {
                $tr->commit();
            } else {
                $tr->rollBack();
            }
        }

        return $result;
    }

    public function actionAjaxOstatne()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $ostatne = json_decode(Yii::$app->request->post('ostatne'),true);
        $applicantId = (int)Yii::$app->request->post('applicant_id');

        $result = [
            'status' => 'ok',
            'applicant_id' => $applicantId
        ];

        $applicant = $this->checkApplicant($applicantId);

        if ($applicant != '') {
            $result = [
                'status' => 'error',
                'msg'   => $applicant,
                'code'  => -100
            ];
        } else {
            $tr = \Yii::$app->db->beginTransaction();

            if (!$this->ulozJazyk($applicantId, $ostatne, $error)) {
                $result = [
                    'status' => 'error',
                    'msg' => __FILE__ . "\n" . $error,
                    'code' => -101
                ];
            }

            if (!$this->ulozZaujmyAVodicak($applicantId, $ostatne, $error)) {
                $result = [
                    'status' => 'error',
                    'msg' => __FILE__ . "\n" . $error,
                    'code' => -102
                ];
            }

            if (!$this->saveOtherKnowledges($applicantId, $ostatne, $error)) {
                $result = [
                    'status' => 'error',
                    'msg' => __FILE__ . "\n" . $error,
                    'code' => -103
                ];
            }
            if ($result['status'] == 'ok') {
                $tr->commit();
            } else {
                $tr->rollBack();
            }
        }
        return $result;
    }

    public function actionAjaxSchoolDelete()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $id = (int)Yii::$app->request->post('item');
        $instituteType = Yii::$app->request->post('institute_type');
        $applicantId = (int)Yii::$app->request->post('applicant_id');
        $result = [
            'status' => 'ok',
            'applicant_id' => $applicantId
        ];
        $applicant = $this->checkApplicant($applicantId);
        if ($applicant != '') {
            $result = [
                'status' => 'error',
                'msg'   => $applicant,
                'code'  => -100
            ];
        } else {
            $school = UchadzacVzdelanieKurzSkola::find()
                ->andWhere(['=','uchadzac_id',$applicantId])
                ->andWhere(['=','poradie',$id])
                ->andWhere(['=','typ_institucie',$instituteType])
                ->one();
            if ($school) {
                $school->delete();
            }
        }
        return $result;
    }

    public function actionAjaxPraca()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $praca = json_decode(Yii::$app->request->post('praca'),true);
        $applicantId = (int)Yii::$app->request->post('applicant_id');
        $result = [
            'status' => 'ok',
            'applicant_id' => $applicantId
        ];

        $applicant = $this->checkApplicant($applicantId);
        if ($applicant != '') {
            $result = [
                'status' => 'error',
                'msg'   => $applicant,
                'code'  => -100
            ];
        } else {
            if (!$this->saveAdditionalWorkInfo($applicantId,$praca, $error)) {
                $result = [
                    'status' => 'error',
                    'msg'   => $error,
                    'code'  => -100
                ];
            }
            if (!$this->saveWorkInfo($applicantId,$praca['praca'], $error)) {
                $result = [
                    'status' => 'error',
                    'msg'   => $error,
                    'code'  => -100
                ];
            }
        }

        return $result;
    }

    private function saveAdditionalWorkInfo($applicantId, $work, &$error)
    {
        $result = true;
        try{
            $workInfo = UchadzacZamestnanie::findOne(['uchadzac_id'=>$applicantId]);
            if (!$workInfo) {
                $workInfo = new UchadzacZamestnanie();
            }
            $workInfo->uchadzac_id = $applicantId;
            $workInfo->dopln_info = $work['dpln_info'];
            $workInfo->save();
        } catch (\Exception $e) {
            $error= $e->getMessage();
            $result = false;
        } catch (\Throwable $t) {
            $error= $t->getMessage();
            $result = false;
        }
        return $result;
    }

    private function saveWorkInfo($applicantId, $work, &$error)
    {
        $result = true;
        $works = $this->processWorkInfo($work);
        if (empty($works)) {
            return $result;
        }
        try{
            foreach ($works as $id => $item) {
                $workItem = new UchadzacZamestnaniePolozky();
                $workItem->uchadzac_id = $applicantId;
                $workItem->poradie = $id + 1;
                $workItem->pozicia = $item['pozicia'];
                $workItem->od = $item['od'];
                $workItem->do = $item['do'];
                $workItem->zamestnavatel = $item['zamestnavatel'];
                $workItem->aktualne = $item['aktualne'] == 'on' ? 1:0;
                $workItem->napln = $item['napln'];
                $workItem->save();
            }
        } catch (\Exception $e) {
            $error= $e->getMessage();
            $result = false;
        } catch (\Throwable $t) {
            $error= $t->getMessage();
            $result = false;
        }
        return $result;
    }

    private function processWorkInfo($praca)
    {
        $work = [];
        $workTmp = explode("///",$praca);
        foreach ($workTmp as $item) {
            $row = explode(";;;",$item);
            if ($row[2] == '') {
                continue;
            }
            $work[$row[0]-1][$row[1]] = $row[2];
        }
        return $work;
    }

    public function actionUlozFotoCv()
    {
        $appId = \Yii::$app->request->post('applicant_id');
        $applicant = Uchadzac::findOne(['id'=>$appId]);

        $applicantDir[] = $applicant->first_name . ' ' . $applicant->last_name;
        $applicantDir[] = $applicant->pozicia->info->title;
        $applicantDir[] = (new \DateTimeImmutable('now'))->format('Y-m-d');

        $applicantDir = implode('_',$applicantDir);
        $targetDir =Yii::getAlias('@webroot')."/../../media/";

        if (!file_exists($targetDir.$applicantDir)) {
            mkdir($targetDir.$applicantDir);
        }

        if ($_FILES['photo']['name'] != '') {
            $targetFile = $targetDir . $applicantDir;
            move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile. '/' . basename($_FILES["photo"]["name"]));
            $this->saveFileToDB($_FILES['photo'], $applicant, UchadzacDoc::DOCTYPE_PHOTO, $applicantDir);
        }

        if ($_FILES['cv']['name'] != '') {
            $targetFile = $targetDir . $applicantDir;
            move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile . '/' . basename($_FILES["cv"]["name"]));
            $this->saveFileToDB($_FILES['cv'], $applicant, UchadzacDoc::DOCTYPE_CV, $applicantDir);
        }

        if ($_FILES['motivationletter']['name'] != '') {
            $targetFile = $targetDir . $applicantDir;
            move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile. '/' . basename($_FILES["motivationletter"]["name"]));
            $this->saveFileToDB($_FILES['motivationletter'], $applicant, UchadzacDoc::DOCTYPE_MOTIVATIONLETTER, $applicantDir);
        }

        $position = $applicant->pozicia->info->auth_item;
        if ($position == 'developer') {
            // TODO: redirect to developer test page
            return $this->redirect(Url::to(['/applicant/dev-test']));
        } elseif ($position == 'asistent') {
            return $this->redirect(Url::to(['/applicant/writting-test']));
        } else {
            // TODO: redirect to thank you page
            return $this->redirect(Url::to(['/applicant/thank-you']));
        }
    }

    private function saveFileToDB($fileData, Uchadzac $applicant, $typ, $targetDir)
    {
        $sql = "update uchadzac_doc set status=0 where uchadzac_id={$applicant->id} and doc_type='{$typ}'";
        \Yii::$app->db->createCommand($sql)->execute();

        $doc = new UchadzacDoc();
        $doc->uchadzac_id = $applicant->id;
        $doc->file_type = $fileData['type'];
        $doc->doc = $fileData['name'];
        $doc->doc_type = $typ;
        $doc->status=1;
        $doc->doc_dir = $targetDir;
        return $doc->save();
    }

    private function ulozVzdelanie(int $uchadzacId, array $vzdelanie)
    {
        $appVzdelanie = new UchadzacVzdelanie();
        $appVzdelanie->uchadzac_id = $uchadzacId;
        $appVzdelanie->dpln_info = $vzdelanie['dpln_info'] ?? "";
        $appVzdelanie->najvyssie_vzdelanie = $vzdelanie['najvyssie_vzdelanie'] ?? 0;
        return $appVzdelanie->save();
    }

    private function ulozSkola(int $uchadzacId, array $vzdelanie, $skolaTyp, &$error)
    {
        $result = true;
        $schools = $this->spracujVzdelanie($vzdelanie,$skolaTyp);
        if (empty($schools)) {
            return $result;
        }
        try{
            foreach ($schools as $id => $item) {
                $school = new UchadzacVzdelanieKurzSkola();
                $school->uchadzac_id = $uchadzacId;
                $school->poradie = $id + 1;
                $school->typ_institucie = $skolaTyp;
                $school->institucia = $item['institucia'];
                $school->od = $item['od'];
                $school->do = $item['do'];
                $school->mesto = $item['mesto'];
                $school->odbor = $item['odbor'];
                $school->save();
            }
        } catch (\Exception $e) {
            $error= $e->getMessage();
            $result = false;
        } catch (\Throwable $t) {
            $error= $t->getMessage();
            $result = false;
        }
        return $result;
    }

    private function spracujVzdelanie(array $vzdelanie, $skolaTyp)
    {
        $school = [];
        $schoolTmp = explode("//",$vzdelanie[$skolaTyp]);
        foreach ($schoolTmp as $item) {
            $row = explode(";;",$item);
            if ($row[2] == '') {
                continue;
            }
            $school[$row[0]-1][$row[1]] = $row[2];
        }
        return $school;
    }

    private function ulozKurz(int $uchadzacId, array $vzdelanie, &$error)
    {
        $courses = $this->spracujVzdelanie($vzdelanie, 'kurzy');
        $result = true;
        try{
            foreach ($courses as $id => $item) {
                $course = new UchadzacVzdelanieKurzSkola();
                $course->uchadzac_id = $uchadzacId;
                $course->poradie = $id + 1;
                $course->typ_institucie = 'kurz';
                $course->institucia = $item['institucia'];
                $course->od = $item['od'];
                $course->do = $item['do'];
                $course->nazov = $item['nazov'];
                $course->certifikat = $item['certifikat'];
                $course->save();
            }
        } catch (\Exception $e) {
            $error= $e->getMessage();
            $result = false;
        } catch (\Throwable $t) {
            $error= $t->getMessage();
            $result = false;
        }
        return $result;
    }

    private function spracujJazyk(array $ostatne)
    {
        $language = [];
        $langTmp = explode("///",$ostatne['jazyk']);
        foreach ($langTmp as $item) {
            $row = explode(";;;",$item);
            if ($row[2] == '') {
                continue;
            }
            $language[$row[0]-1][$row[1]] = $row[2];
        }
        return $language;
    }

    private function ulozJazyk(int $appId, array $ostatne, &$error)
    {
        $languages = $this->spracujJazyk($ostatne);
        $result = true;
        try{
            foreach ($languages as $id => $item) {
                $lang = UchadzacJazyk::findOne(['uchadzac_id'=>$appId,'poradie'=> $id+1]);
                if (!$lang) {
                    $lang = new UchadzacJazyk();
                    $lang->uchadzac_id = $appId;
                    $lang->poradie = $id + 1;
                }
                $lang->jazyk_id = $item['jazyk_id'];
                $lang->uroven = $item['uroven'];
                $lang->save();
            }
        } catch (\Exception $e) {
            $error= $e->getMessage();
            $result = false;
        } catch (\Throwable $t) {
            $error= $t->getMessage();
            $result = false;
        }
        return $result;
    }

    private function processOtherKnowledges($other)
    {
        $knowledges = json_decode($other['znalosti'],true);
        $result = [];

        foreach ($knowledges as $key => $item) {
            if ((int)$item[0] != 0) {
                $result[$key] = $item[1];
            }
        }

        return $result;
    }

    // TODO: check why is not saving the records!!!
    private function saveOtherKnowledges($appId, array $other, &$error)
    {
        $others = $this->processOtherKnowledges($other);
        $result = true;
        try{
            foreach ($others as $id=>$item) {
                $other = UchadzacZnalosti::findOne(['uchadzac_id'=>$appId,'poradie'=> $id+1]);
                if (!$other) {
                    $other = new UchadzacZnalosti();
                    $other->uchadzac_id = $appId;
                    $other->poradie = $id + 1;
                }
                $other->znalost = $item['znalost'];
                $other->uroven = $item['uroven'];
                $other->save();
            }
        }  catch (\Exception $e) {
            $error= $e->getMessage();
            $result = false;
        } catch (\Throwable $t) {
            $error= $t->getMessage();
            $result = false;
        }
        return $result;
    }

    private function spracujVodicak(array $ostatne)
    {
        $vodicak = json_decode($ostatne['vodicak'],true);
        $result = [];

        foreach ($vodicak as $key => $item) {
            if ((int)$item[0] != 0) {
                $result[$key] = $item[1];
            }
        }

        return $result;
    }

    private function ulozZaujmyAVodicak(int $uchadzacId, array $ostatne, &$error)
    {
        $vodicak = $this->spracujVodicak($ostatne);
        $result = true;
        if (empty($vodicak) && $ostatne['zaujmy'] == '') {
            return $result;
        }
        try {
            $ostatneItem = UchadzacOstatne::findOne(['uchadzac_id' => $uchadzacId]);
            if (!$ostatneItem) {
                $ostatneItem = new UchadzacOstatne();
                $ostatneItem->uchadzac_id = $uchadzacId;
            }
            foreach ($vodicak as $key => $item) {
                $id = "vod_{$key}";
                $ostatneItem->$id = 1;
                $id = "jazdene_{$key}";
                $ostatneItem->$id = $item;
            }
            if ($ostatne['zaujmy'] != '') {
                $ostatneItem->zaujmy = $ostatne['zaujmy'];
            }
            $ostatneItem->save();
        } catch (\Exception $e) {
            $error= $e->getMessage();
            Yii::getLogger()->log($e->getMessage(),E_ALL);
            $result = false;
        } catch (\Throwable $t) {
            $error= $t->getMessage();
            Yii::getLogger()->log($t->getMessage(),E_ALL);
        }

        return $result;
    }

    private function checkApplicant(int $applicantId)
    {
        $result = '';
        if ($applicantId == 0) {
            $result = 'Uchádzač sa nenachádze v databáze';
        } else {
            $applicant = Uchadzac::findOne(['id'=>$applicantId]);
            if (!$applicant) {
                $result = 'Uchádzač sa nenachádze v databáze2';
            }
        }
        return $result;
    }



}