<?php
namespace backend\controllers;

use common\models\documents\templatedocuments\PdfTemplateDocument;
use common\models\Template;
use yii\helpers\StringHelper;
use yii\helpers\Url;
use yii\web\Controller;
use common\models\property\Offer;
use Yii;

class OffersController extends Controller
{

    public function beforeAction($action)
    {
        if (is_null(Yii::$app->user->identity)) {
            $this->redirect(Url::to(['/site/login']));
            return false;
        }
        return parent::beforeAction($action);
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index',[
            'offers' => $this->getOfferList(),
            'senders' => $this->getSenders()
        ]);
    }

    public function actionGenerateList()
    {
        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post('Data');
            $template = Template::findOne(['id'=>474]);
            $doc = new PdfTemplateDocument();
            $doc->setTemplateContent($template->content);
            unset($template);
            $offerIds = $this->getOfferIds($data['recips']);
            $doc->setTemplateData([
                'offer' => Offer::find()->where(['in','id', $offerIds])->all(),
                'input.miesto_podpisu_hu'  => $data['miesto_podpisu']['HU'],
                'input.miesto_podpisu_sk'  => $data['miesto_podpisu']['SK'],
                'input.datum_podpisu_hu'   => (new \DateTimeImmutable($data['datum_podpisu']['HU']))->format('Y.m.d'),
                'input.datum_podpisu_sk'   => (new \DateTimeImmutable($data['datum_podpisu']['SK']))->format('d.m.Y'),
                'input.buyer_name_hu'      => $data['buyer_name']['HU'],
                'input.buyer_name_sk'      => $data['buyer_name']['SK'],
                'input.buyer_email_hu'     => $data['buyer_email']['HU'],
                'input.buyer_email_sk'     => $data['buyer_email']['SK'],
                'input.buyer_phone_sk'     => $data['buyer_phone']['SK'],
                'input.buyer_phone_hu'     => $data['buyer_phone']['HU'],
            ]);
            $doc->create();
            $doc->downloadFile();
            $sql = "UPDATE offer SET informed=1 WHERE id in (". implode(",",$offerIds) .")";
            Yii::$app->db->createCommand($sql)->execute();
        }
        $this->redirect('/offers/index',200);
    }

    public function actionImport()
    {
        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post('Import');
            if (empty($_FILES) || $_FILES['DataFile']['type'] != 'application/vnd.ms-excel') {
                Yii::$app->session->setFlash('error',Yii::t('app','Nahratý súbor má zlý formát! Nahrajte CSV súbor (UTF8)!'));
            } else {
                $result = $this->processCsvInput($_FILES['DataFile']['tmp_name'], $data['delimiter']);
                $sql = "insert into offer (`propertyType`,`orderNumber`,`gender`,`name`,`lastName`,`maidenName`,".
                    "`birthDate`,`ownerAddress`,`ownerTown`,`coOwnership`,`acquisitionTitle`,`encumbrance`,".
                    "`registerNumber`,`parcelNumber`,`ownershipDocumentNumber`,`propertyAddress`)  values %s";
                $rows = [];
                foreach($result as $item) {
                    $rows[] = "(".implode(',',[
                            $data['type'],
                            $item['orderNumber'] != '' ? $item['orderNumber'] : 'null' ,
                            $item['gender'],
                            "'{$item['name']}'",
                            "'{$item['lastName']}'",
                            "'{$item['maidenName']}'",
                            "'{$item['birthDate']}'",
                            "'{$item['ownerAddress']}'",
                            "'{$item['ownerTown']}'",
                            "'{$item['coOwnership']}'",
                            "'{$item['acquisitionTitle']}'",
                            "'{$item['encumbrance']}'",
                            "'{$item['registerNumber']}'",
                            "'{$item['parcelNumber']}'",
                            "'{$item['ownershipDocumentNumber']}'",
                            "'{$item['propertyAddress']}'"
                        ]).")";
                }
                $sql = sprintf($sql, implode(',',$rows));
                $tr = Yii::$app->db->beginTransaction();
                try{
                    Yii::$app->db->createCommand($sql)->execute();
                    $tr->commit();
                    Yii::$app->session->setFlash('success', Yii::t('app','Údaje boli úspešne nahraté'));
                    return $this->redirect(Url::to(['/offers']));
                } catch(\Exception $e) {
                    $tr->rollBack();
                    Yii::$app->session->setFlash('error',$e->getMessage());
                }
            }
        }

        return $this->render('import',[
        ]);
    }

    public function actionEdit(int $on)
    {
        return $this->render('edit');
    }

    private function getOfferIds(string $ids): array
    {
        $ids = explode(',',trim($ids));
        $returns = [];
        foreach($ids as $id) {
            $this->processOfferId($id, $returns);
        }
        return $returns;
    }

    private function processOfferId($orderNumber, array &$returns): void
    {
        $orderNumber = trim($orderNumber);
        if (is_numeric($orderNumber)) {
            $returns = array_merge($returns, [$this->getOfferIdFromOrderNumber($orderNumber)]);
        } elseif(strpos($orderNumber,'-') !== false) {
            list($start,$end) = explode('-',$orderNumber);
            for($i=$start;$i<=$end;$i++) {
                $returns = array_merge($returns, [$this->getOfferIdFromOrderNumber($i)]);
            }
        }
    }

    private function getOfferIdFromOrderNumber(int $orderNumber): int
    {
        $result = Offer::find()->where(['=','orderNumber',$orderNumber])->all();
        return ($result[0])->id;
    }

    private function getSenders(): array
    {
        $sql = "select
                    id, name, email, phone, town, contact_person, 'office' as SenderType 
                from 
                    office
                union 
                select
                    id, concat(name_first, ' ',name_last) as name, email, phone, '' as town, '' as contact_person, 'private' as SenderType
                from
                    agent
                where 
                    id=1";
        return Yii::$app->db->createCommand($sql)->queryAll();
    }

    private function getOfferList(): array
    {

        $sql = "select 
                    GROUP_CONCAT(id SEPARATOR '<br>') AS `id`, 
                    orderNumber, GROUP_CONCAT(gender SEPARATOR '<br>') AS gender,
                    GROUP_CONCAT(CONCAT(`name`,' ',lastName) SEPARATOR '<br>') AS `name`,
                    GROUP_CONCAT(ownerAddress SEPARATOR '<br>') AS ownerAddress,
                    GROUP_CONCAT(ownerTown SEPARATOR '<br>') AS ownerTown,
                    GROUP_CONCAT(ownerZip SEPARATOR '<br>') AS ownerZip,
                    GROUP_CONCAT(coOwnership SEPARATOR '<br>') AS coOwnership,
                    GROUP_CONCAT(birthDate SEPARATOR '<br>') AS birthDate,
                    acquisitionTitle,
                    encumbrance,
                    registerNumber,
                    parcelNumber,
                    ownershipDocumentNumber,
                    propertyAddress,
                    `status`,
                    informed
                from
                    offer
                where 
                    orderNumber is not NULL
                group by
                    orderNumber
                union
                select 
                    id, orderNumber, gender, CONCAT(`name`,' ',lastName) AS `name`, ownerAddress, ownerTown,ownerZip,coOwnership,
                    birthDate,
                    acquisitionTitle,
                    encumbrance,
                    registerNumber,
                    parcelNumber,
                    ownershipDocumentNumber,
                    propertyAddress,
                    `status`,
                    informed
                from
                    offer 
                where
                    orderNumber is NULL";

        return Yii::$app->db->createCommand($sql)->queryAll();
    }

    private function processCsvInput(string $csvFile, string $separator): array
    {
        // remove BOM string
        //
        $content = file_get_contents($csvFile);
        file_put_contents($csvFile, str_replace("\xEF\xBB\xBF",'', $content));

        $result = [];
        if (($hFile = fopen($csvFile, "r")) !== FALSE) {
            while (($data = fgetcsv($hFile, 1000, $separator)) !== FALSE) {
                $result[] = [
                    'orderNumber'               =>  $this->sanitizeString($data[0]),
                    'gender'                    =>  $this->transformGender($data[1]),
                    'name'                      =>  $this->sanitizeString($data[2]),
                    'lastName'                  =>  $this->sanitizeString($data[3]),
                    'maidenName'                =>  $this->sanitizeString($data[4]),
                    'birthDate'                 =>  $this->convertDate($data[5]),
                    'ownerAddress'              =>  $this->sanitizeString($data[6]),
                    'ownerTown'                 =>  $this->sanitizeString($data[7]),
                    'coOwnership'               =>  $this->convertCoOwnerShip($data[8]),
                    'acquisitionTitle'           =>  $this->sanitizeString($data[9]),
                    'encumbrance'               =>  $this->sanitizeString($data[10]),
                    'registerNumber'            =>  $this->sanitizeString($data[11]),
                    'parcelNumber'              =>  $this->sanitizeString($data[12]),
                    'ownershipDocumentNumber'   =>  $this->sanitizeString($data[13]),
                    'propertyAddress'           =>  $this->sanitizeString($data[14])
                ];
            }
            fclose($hFile);
        }

        return $result;
    }

    private function transformGender(string $gender): int
    {
        return $gender == 'M' ? 0 : 1;
    }

    private function sanitizeString(string $str): string
    {
        return trim($str);
    }

    private function convertDate(string $date, string $dateFormat='Y-m-d'): string
    {
        $date = $this->sanitizeString($date);
        $date = str_replace('/','',$date);
        $date = str_replace('?','',$date);
        if (strlen($date) == 0) {
            return '';
        }
        return (new \DateTime($date))->format($dateFormat);
    }

    private function convertCoOwnerShip(string $ownerShip): string
    {
        return str_replace('.','/',$this->sanitizeString($ownerShip));
    }

}