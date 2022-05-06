<?php
namespace common\models\documents\templatedocuments;

use Mpdf\Mpdf;
use Mpdf\Config\ConfigVariables;
use Mpdf\Config\FontVariables;
use Mpdf\MpdfException;
use Mpdf\Output\Destination;
use yii\helpers\StringHelper;
use Yii;

class PdfTemplateDocument extends TemplateDocument
{
    protected $mpdf = null;
    protected $documentProtection = false;

    public function __construct()
    {
        $defaultConfig = (new ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir'];

        $defaultFontConfig = (new FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];
        try {
            $this->mpdf = new Mpdf([
                'fontDir' => array_merge($fontDirs, [
                    __DIR__ . "/../../../backend/templates/font",
                ]),
                'fontdata' => $fontData + [
                        'copperplate' => [
                            'R' => 'Copperplate Gothic Bold Regular.ttf',
                            'I' => 'Copperplate Gothic Bold Regular.ttf',
                            'B' => 'Copperplate Gothic Bold Regular.ttf',
                        ]
                    ],
                'default_font' => 'Arial Narrow'
            ]);
        } catch(MpdfException $e) {
            echo $e->getMessage();
            exit;
        }

        if ($this->documentProtection) {
            $this->mpdf->SetProtection([
                'print',
                'print-highres'
            ]);
        }

    }

    public function create(): void
    {
        foreach($this->templateData as $key => $item) {
            if (is_array($item)) {
                $templateCount = count($item);
                foreach($item as $r) {
                    $this->processTemplateData($r, $key);
                    --$templateCount;
                    if (0 != $templateCount) {
                        $this->templateContent .= $this->templateContentStore;
                    }
                }
            } else {
                $this->processTemplateData($item, $key);
            }
        }
    }

    private function processTemplateData($item, $key): void
    {
        if ($item instanceof \yii\db\ActiveRecord) {
            foreach($item->attributes() as $attr) {
                $this->templateContent = str_replace("[{$key}.{$attr}]",$item->$attr,$this->templateContent);
            }
        }
        if (is_string($item) && StringHelper::startsWith($key,'input.')) {
            $this->templateContent = str_replace("[{$key}]",$item,$this->templateContent);
        }
    }

    public function writeToFile(): void
    {
        $this->fileName = "print-" . time() . ".pdf";
        try{
            $this->mpdf->WriteHTML($this->templateContent);
        } catch(\Mpdf\MpdfException $ex) {
            echo $ex->getLine();
            print_r($ex->getTrace());
            exit;
        }
        $this->mpdf->Output(Yii::getAlias('@webroot')."/../docstore/offers/".$this->fileName, Destination::FILE);
    }

    public function downloadFile(): void
    {
        $this->fileName = "print-" . time() . ".pdf";
        try{
            $this->mpdf->WriteHTML($this->templateContent);
        } catch(\Mpdf\MpdfException $ex) {
            echo $ex->getLine();
            print_r($ex->getTrace());
            exit;
        }
        $this->mpdf->Output($this->fileName, Destination::DOWNLOAD);
    }
}