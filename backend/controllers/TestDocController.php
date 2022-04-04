<?php

namespace backend\controllers;

use common\models\documentsx\Documents;
use yii\web\Controller;
use common\models\mrp\xmlgenerator\XmlGenerator;
use common\models\Invoice;
use common\models\mrp\xmlgenerator\MrpInvoice;
use common\models\mrp\xmlgenerator\Settings;

class TestDocController extends Controller
{

    // public function actionProba(int $id)
    // {
    //     $doc = new Documents();
    //     $doc
    //         ->setId($id)
    //         ->setPreview(true);
    // }

    public function actionIndex()
    {
        $invoices = Invoice::find()->all();
        $mrpInvoices = new MrpInvoice($invoices);
        $results = $mrpInvoices->process();

        $settings = new Settings;
        $generator = new XmlGenerator($results, $settings);
        $generator->create();
        $generator->downloadFile('tojejedno.xml');
    }
}
