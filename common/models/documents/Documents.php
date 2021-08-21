<?php
namespace common\models\documents;

use common\models\NehnutelnostDokumenty;
use common\models\Zmluva;
use Mpdf\Mpdf;
use Mpdf\Output\Destination;
use Mpdf\Config\ConfigVariables;
use Mpdf\Config\FontVariables;
use Yii;
use common\models\Office;

abstract class Documents
{
    protected $mpdf = null;
    protected $template;
    protected $usePaging = false;
    protected $fileName;
    protected $templateData = [];
    protected $content="";
    protected $date=null;
    protected $podpisMiesto=null;
    protected $otherData = null;
    protected $office = null;

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
        /*$this->mpdf->SetProtection([
            'print',
            'print-highres'
        ]);*/
    }

    public function setPoradie(int $poradie)
    {

    }

    public function setDate($datum)
    {
        $this->date = $datum;
    }

    public function setPodpisMiesto($miesto)
    {
        $this->podpisMiesto = $miesto;
    }

    public function getPodpisMiesto()
    {
        return $this->podpisMiesto ?? "";
    }

    public function setOtherData($data)
    {
        $this->otherData = $data;
    }

    public function getOtherData()
    {
        return $this->otherData;
    }

    public function setOffice(int $id)
    {
        $this->office = Office::findOne(['id'=>$id]);
    }

    public function getOffice()
    {
        return $this->office;
    }

    protected function getDate($format=null)
    {
        $format = is_null($format) ? "d.m.Y" : $format;
        return is_null($this->date) ? (new \DateTime())->format($format) : (new \DateTime($this->date))->format($format);
    }

    protected function setFileName($fileName)
    {
        $this->fileName = $fileName;
    }

    public function getFileName()
    {
        return $this->fileName;
    }

    public function setTemplate($template)
    {
        $this->template = $template;
    }

    public function enablePageNumbering()
    {
        $this->mpdf->SetHTMLFooter('<div style="text-align: right;">{PAGENO}</div>');
    }

    public function getTemplate()
    {
        return $this->template;
    }

    protected function getTemplatePath()
    {
        return Yii::getAlias('@backend')."/templates/";
    }

    public function create()
    {
        // zapnutie strankovania
        if ($this->usePaging) {
            $this->enablePageNumbering();
        }
        $this->getTemplateData();
        $this->content = $this->render($this->template, $this->templateData);
    }

    protected function render($template, array $data)
    {
        $content = file_get_contents($this->getTemplatePath().$template.".tpl");
        // naplnenie sablony s udajmi
        foreach ($data as $key=>$item) {
            $content = str_replace('{{'.$key.'}}', $item, $content);
        }

        return $content;
    }

    abstract protected function getTemplateData();

    protected function writeToDatabase($contractNumber, $docType, $poradie=1)
    {
        $zmluva = Zmluva::findOne(['cislo'=>$contractNumber]);

        // najprv oznacime statusom vsetky starsie dokumenty
        $sql = "update nehnut_dokumenty set status=0 where dokument_typ='{$docType}' and zmluva_cislo='{$contractNumber}' and poradie={$poradie}";
        Yii::$app->db->createCommand($sql)->execute();

        $dokument = new NehnutelnostDokumenty();
        $dokument->zmluva_id = $zmluva->id;
        $dokument->zmluva_cislo = $contractNumber;
        $dokument->dokument = $this->fileName;
        $dokument->dokument_typ = $docType;
        $dokument->poradie = $poradie;
        $dokument->uploaded_at = (new \DateTimeImmutable('now'))->format('Y-m-d H:i:s');
        $dokument->uploaded_by = Yii::$app->user->identity->getId();
        $dokument->save();

        return true;
    }

    protected function writeToFile($contractNumber)
    {
        $this->fileName = $contractNumber."-".$this->template."-".time().".pdf";
        try{
            $this->mpdf->WriteHTML($this->content);
        } catch(\Mpdf\MpdfException $ex) {
            echo $ex->getLine();
            print_r($ex->getTrace());
            exit;
        }
        $this->mpdf->Output(Yii::getAlias('@webroot')."/../docstore/".$contractNumber."/".$this->fileName, Destination::FILE);
    }

    public function downloadFile($contractNumber)
    {
        $this->fileName = $contractNumber."-".$this->template."-".time().".pdf";
        try{
            $this->mpdf->WriteHTML($this->content);
        } catch(\Mpdf\MpdfException $ex) {
            echo $ex->getLine();
            print_r($ex->getTrace());
            exit;
        }
        $this->mpdf->Output($this->fileName, Destination::DOWNLOAD);
    }

}