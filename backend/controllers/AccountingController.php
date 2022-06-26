<?php

namespace backend\controllers;

use Smalot\PdfParser\Parser;
use common\models\Accounting;
use common\models\documents\FakturaDocument;
use common\models\documents\PPDDocument;
use common\models\documents\VPDDocument;
use common\models\Office;
use yii\db\Exception;
use yii\helpers\StringHelper;
use yii\web\Controller;
use common\models\Invoice;
use yii\web\Response;
use Yii;
use common\models\mrp\xmlgenerator\MrpInvoice;
use common\models\mrp\xmlgenerator\Settings;
use common\models\mrp\xmlgenerator\XmlGenerator;
use common\models\reader\InvoiceReader;
use common\models\reader\SlovakInvoiceReader;

class AccountingController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'invoice' => [
                'class' => 'backend\actions\accounting\InvoiceAction'
            ],
            'add-invoice' => [
                'class' => 'backend\actions\accounting\AddInvoiceAction'
            ],
            'index'     => [
                'class' => 'backend\actions\accounting\IndexAction'
            ],
            'cash-receipt' => [
                'class' => 'backend\actions\accounting\CashReceiptAction'
            ],
            'add-receipt'   => [
                'class' => 'backend\actions\accounting\AddReceiptAction'
            ],
            'edit-receipt'  => [
                'class' =>  'backend\actions\accounting\EditReceiptAction'
            ],
            'edit-invoice'  => [
                'class' => 'backend\actions\accounting\EditInvoiceAction'
            ],
            'edit-cash-receipt' => [
                'class' => 'backend\actions\accounting\EditCashReceiptAction'
            ],
            'make-invoice'  => [
                'class' => 'backend\actions\accounting\MakeInvoiceAction'
            ],
            'report'    =>  [
                'class' =>  'backend\actions\accounting\ReportAction'
            ],
            'add-received-invoice' => [
                'class' =>  'backend\actions\accounting\AddReceivedInvoiceAction'
            ]
        ];
    }

    public function actionPrint(string $t, int $id)
    {
        switch ($t) {
            case 'VPD': {
                $doc = new VPDDocument();
                $doc->setTemplate('vpd');
                $doc->setId($id);
                $doc->create();
                $doc->downloadFile($id);
            }
                break;
            case 'PPD': {
                $doc = new PPDDocument();
                $doc->setTemplate('ppd');
                $doc->setId($id);
                $doc->create();
                $doc->downloadFile($id);
            }
                break;
            case 'ZAL':
            case 'FAK': {
                $faktura = new FakturaDocument($id);
                $faktura->setTemplate('inv');
                $faktura->create();
                $faktura->downloadFile((Invoice::findOne(['id'=>$id]))->getInvoiceNumber());
            }
                break;
            default:
                throw new Exception('Nepodporovany format!!!', 404);
        }
    }

    public function actionAjaxCompanyDetails()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $result = ['status'=>'ok'];
        $companyId = Yii::$app->request->post('company_id');

        $office = Office::findOne(['id'=>$companyId]);
        if (!$office) {
            $result = ['status'=>'error', 'message'=>'Company not found!'];
        } else {
            $details = $office->toArray();
            foreach($office->accounts as $account) {
                $bank[] = [
                    'name'  => $account->details->name,
                    'swift' => $account->swift,
                    'iban'  => $account->iban,
                    'currency' => $account->currency
                ];
            }
            $details['banks'] = $bank ?? [];
            $lastInvoiceNumber = (new Accounting())->getNextInvoiceNumber($office);
            $details['lastInvoiceNumber'] = $lastInvoiceNumber;
            $details['vs'] = preg_replace('/[A-Z]{1,}/','',$lastInvoiceNumber);
            $result['details']=$details;
        }

        return $result;
    }

    public function actionAjaxDeleteInvoiceItem()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $result = ['status'=>'ok'];

        $itemId = Yii::$app->request->post('itemid');
        if ((int)$itemId <= 0) {
            return ['status'=>'error','msg'=>'Chybné číslo položky'];
        }
        Yii::$app->db->createCommand("DELETE FROM faktura_polozky WHERE id={$itemId}")->execute();

        return $result;
    }

    public function actionAjaxGetNewInvoiceNumber()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $result =

        $oldNumber = Yii::$app->request->post('oldnumber');
        $invoiceType = Yii::$app->request->post('invtype');

        $oldNumber = preg_replace('/[0-9]{1,}/','',$oldNumber);
        if ($invoiceType == 1) {
            $oldNumber = "X{$oldNumber}";
        } else {
            $oldNumber = str_replace("X","", $oldNumber);
        }
        $year = (new \DateTime('now'))->format("Y");
        $invoice = Yii::$app->db->createCommand("
            select cislo from faktura where znak='{$oldNumber}' and rok='{$year}' order by id DESC
        ")->queryOne();

        if (!$invoice) {
            $num = str_pad('1',4,'0',STR_PAD_LEFT);
        } else {
            $num = (int)$invoice['cislo'] + 1;
            $num = str_pad($num, 4, '0',STR_PAD_LEFT);
        }

        return [
            'status'    =>  'ok',
            'var_symb'  =>  "{$year}0{$num}",
            'inv_num'   =>  "{$oldNumber}{$year}0{$num}",
        ];
    }

    public function actionAjaxUpdateStatus()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $invoiceId = Yii::$app->request->post('invoice');
        $status = Yii::$app->request->post('istatus');

        $tr = Yii::$app->db->beginTransaction();
        try {
            $invoice = Invoice::findOne(['id'=>$invoiceId]);
            $invoice->status = $status + 1;
            $invoice->save();
            $tr->commit();
        } catch (\Exception $e) {
            $tr->rollBack();
            return [
                'status'    => 'error',
                'message'   =>  $e->getMessage(),
                'code'      =>  -1
            ];
        } finally {
            unset($invoice);
        }

        return [
            'status'    =>  'ok',
            'invoice'   =>  $invoiceId
        ];
    }

    // mal som problem s Csrf validaciou a toto bola jedina vec ktoru som nasiel ze fungovala
    // public $enableCsrfValidation = false;

    public function actionInvoiceExport()
    {

        /*if(Yii::$app->request->isPost)
        {
            $data = Yii::$app->request->post();
            $nazovFirmy = $data['Invoice']['znak'];
            $datumOd = $data['Invoice']['datum_vystavenia'];
            $datumDo = $data['Invoice']['datum_dodania'];

            $invoices = Invoice::find()->where([
                'znak' => $nazovFirmy,
                'datum_vystavenia' => $datumOd,
                'datum_dodania' => $datumDo
            ])->all();

            $mrpInvoice = new MrpInvoice($invoices);
            $results =  $mrpInvoice->process();

            $settings = new Settings;
            $generator = new XmlGenerator($results, $settings);
            $generator->create();
            $generator->downloadFile('faktura.xml');

        return $this->render('invoice/invoice-export');

        }*/
        return $this->render('invoice/invoice-export',[
            'offices' => Office::find()->select('id,name')->asArray()->all()
        ]);
    }

    public function actionLoadInvoices()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        var_dump(Yii::$app->request->post('s'));
        exit;

    }

    public function actionInvoiceImport()
    {
        $parser = new Parser();
        $texts = [];

        if (Yii::$app->request->isPost) {
            $pdf = Yii::$app->request->post('faktura');
            $pdf = $parser->parseFile("C:\Users\Mirko\Desktop/" . $pdf);

            foreach ($pdf->getPages() as $page) {
                $texts = array_merge($texts, $page->getTextArray());
            }

            $invoiceReader = new SlovakInvoiceReader($texts);
            $iban = $invoiceReader->getIban();
            $dodavatel = $invoiceReader->getDodavatel();
            $bic = $invoiceReader->getBic();
            $cisloUctu = $invoiceReader->getAccountNumber();
            $dic = $invoiceReader->getTaxNumber();
            // $ulcia = $invoiceReader->getUlica();
            $ico = $invoiceReader->getBusinessId();
            $payment = $invoiceReader->getPayment();
            $vat = $invoiceReader->getVat();
            $dates = $invoiceReader->getDates();
            $variableSymbol = $invoiceReader->getVariableSymbol();
            echo "<pre>";
            var_dump($vat);
            exit;
        }

        return $this->render('invoice/invoice-import');
    }
}
