<?php
namespace common\models\documentsx;

use Mpdf\Mpdf;
use Mpdf\Config\ConfigVariables;
use Mpdf\Config\FontVariables;
use Yii;

class Documents
{
    protected $pageNumbering = false;
    protected $content = null;
    protected $template = null;
    protected $docType = null;
    protected $preview = false;
    protected $id = null;
    protected $fileName = null;

    public function __construct()
    {
        $defaultConfig = (new ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir'];

        $defaultFontConfig = (new FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];
        $this->mpdf = new Mpdf([
            'fontDir' => array_merge($fontDirs, [
                __DIR__."/../../../backend/templates/font",
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
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Documents
    {
        $this->id = $id;
        return $this;
    }

    public function isPageNumbering(): bool
    {
        return $this->pageNumbering;
    }

    public function setPageNumbering(bool $pageNumbering)
    {
        $this->pageNumbering = $pageNumbering;
    }

    public function isPreview(): bool
    {
        return $this->preview;
    }

    public function setPreview(bool $preview): Documents
    {
        $this->preview = $preview;
        return $this;
    }

    protected function insertPageNumbering()
    {
         $this->mpdf->SetHTMLFooter('<div style="text-align: right;">{PAGENO}</div>');
    }

    protected function getTemplatePath(): string
    {
        return Yii::getAlias('@backend')."/templates/";
    }

    protected function getDocStorePath(): string
    {
        return Yii::getAlias('@webroot')."/../docstore/";
    }

    protected function writeToFile()
    {

    }


}