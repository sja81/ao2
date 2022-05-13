<?php

namespace backend\controllers;

use common\models\documentsx\Documents;
use yii\web\Controller;
use common\models\mrp\xmlgenerator\XmlGenerator;
use common\models\Invoice;
use common\models\mrp\xmlgenerator\MrpInvoice;
use common\models\mrp\xmlgenerator\Settings;
use common\models\Template;
use common\models\documents\templatedocuments\PdfTemplateDocument;



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
        $template = Template::findOne(['id' => 12]);
        $doc = new PdfTemplateDocument();
        $doc->setTemplateContent($template->content);
        unset($template);
        
        $doc->setTemplateData([
           'school' => "",
           'month' => "4",
           'school_adress' => "",
           'block.trainee.name_first.name_last' => "Jakub Makovický",
           'trainee.employer' => "",


        ]);
        $doc->create();
        $doc->downloadFile();

    
        


    }

   

    public function actionTemplate13()
    {
        $template = Template::findOne(['id' => 13]);
        $doc = new PdfTemplateDocument();
        $doc->setTemplateContent($template->content);
        unset($template);
        
        $doc->setTemplateData([
         

        ]);
        $doc->create();
        $doc->downloadFile();
    }

    public function actionTemplate14()
    {
        $template = Template::findOne(['id' => 14]);
        $doc = new PdfTemplateDocument();
        $doc->setTemplateContent($template->content);
        unset($template);
        
        $doc->setTemplateData([
           'school' => "",
           'month' => "4",
           'school_adress' => "",
           'block.trainee.name_first.name_last' => "Jakub Makovický",
           'trainee.employer' => "",


        ]);
        $doc->create();
        $doc->downloadFile();

    }

    public function actionTemplate15()
    {
        $template = Template::findOne(['id' => 15]);
        $doc = new PdfTemplateDocument();
        $doc->setTemplateContent($template->content);
        unset($template);
       
        
        
        
        
     
        
        $doc->setTemplateData([
           'trainee.employer' => "",
           'month' => "4",
           'principalinstructor.ac_deg_before.ac_deg_after.name_first.name_last' => "",
           'block.trainee.name_first.name_last' => "Jakub Makovický",
           'block.trainee.name_first.name_las' => "",
            'block.trainee.name_first.name_last' => "",
            'input.datum_podpisu' => "",

        ]);
        $doc->create();
        $doc->downloadFile();

    }

    
}
