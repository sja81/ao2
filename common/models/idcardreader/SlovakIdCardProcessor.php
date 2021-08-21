<?php
namespace common\models\idcardreader;

use common\models\AcademicDegrees;
use common\models\Mesto;
use Google\Cloud\Vision\VisionClient;
use Yii;

class SlovakIdCardProcessor
{
    private $images = [];
    private $vision = null;

    public function __construct()
    {
        $keyFile = file_get_contents(Yii::getAlias('@webroot').'/'.Yii::$app->params['google_key_file']);

        $this->vision = new VisionClient([
            'keyFile'   => json_decode($keyFile,true)
        ]);
    }

    public function pridajPrednuStranu($image)
    {
        $this->images['predna'] = $image;
    }

    public function pridajZadnuStranu($image)
    {
        $this->images['zadna'] = $image;
    }

    private function annotateText($image)
    {
        $imageRes = fopen($image,'r');
        $input = $this->vision->image($imageRes, ['TEXT_DETECTION']);
        $result = $this->vision->annotate($input);
        return ($result->text())[0]->description();
    }

    public function processDocument($dateFormat = 'd.m.Y')
    {
        $text = "";
        $result = [];
        $text .= $this->annotateText($this->images['predna']);
        $text .= $this->annotateText($this->images['zadna']);

        $result['doc_type'] = 20;

        $text = str_replace("\n",'||', $text);
        $result['nationality'] = 1;
        $text = str_replace('SVK','',$text);
        $text = str_replace('Štátne občianstvo / Nationality', '', $text);
        $text = str_replace('||||','||',$text);
        $text = preg_replace("/\s{0,}\|\|Address/m",'Address',$text);

        if (preg_match_all("/Pohlavie\s{0,}\/\s{0,}Sex\s{0,}\|\|\s{0,}[M|F]{1}\s{0,}\|\|/m", $text, $matches)) {
            $result['gender'] = strtolower(str_replace('||','',str_replace('Pohlavie / Sex||','', $matches[0][0])));
        }

        if (preg_match_all("/\s{0,}Dátum\s{0,}narodenia\s{0,}\/\s{0,}Date\s{0,}of\s{0,}birth\s{0,}\|\|[0-9]{2}\.[0-9]{2}\.[0-9]{4}\.{0,}\|\|/m", $text, $matches)) {
            $dob = trim(str_replace('||','',str_replace('Dátum narodenia / Date of birth||','',$matches[0][0])));
            $result['birth_date'] = (new \DateTimeImmutable($dob))->format($dateFormat);
        }

        if (preg_match_all("/\s{0,}Priezvisko\s{0,}\/\s{0,}Surname\|\|[\w\s]{1,}\|\|/m", $text, $matches)) {
            $result['name_first'] = trim(str_replace('||','',str_replace('Priezvisko / Surname||','',$matches[0][0])));
        }

        if (preg_match_all("/\s{0,}Meno\s{0,}\/\s{0,}Given\s{0,}names\|\|[\w\s]{1,}\|\|/m",$text, $matches)) {
            $result['name_last'] = trim(str_replace('||','',str_replace('Meno / Given names||','',$matches[0][0])));
        }

        if (preg_match_all("/\s{0,}Rodné\s{0,}číslo\s{0,}\/\s{0,}Personal\s{0,}No.\s{0,}\|\|[0-9]{6}\/[0-9]{3,4}\|\|/m",$text,$matches)) {
            $result['ssn'] = trim(str_replace('||','',str_replace('Rodné číslo / Personal No.||','',$matches[0][0])));
        }

        if (preg_match_all("/\s{0}Čís[i|l]{1}o\s{0,}\/\s{0,}No\.\s{0,}\|\|[A-Z]{2,}[0-9]{6,}\|\|/m",$text, $matches)) {
            $result['doc_number'] = trim(str_replace('||','',preg_replace("/\s{0,}Čís[i|l]{1}o\s{0,}\/\s{0,}No.\s{0,}\|\|\s{0,}/m",'',$matches[0][0])));
        }

        if (preg_match_all("/\s{0,}Dátum\s{0,}platnosti\s{0,}\/\s{0,}Date\s{0,}of\s{0,}expiry\s{0,}\|\|[0-9]{2}\.[0-9]{2}\.[0-9]{4}\.{0,}\s{0,}\|\|/m",$text,$matches)) {
            $validity = trim(str_replace('||','', preg_replace("/\s{0,}Dátum\s{0,}platnosti\s{0,}\/\s{0,}Date\s{0,}of\s{0,}expiry\s{0,}\|\|/m",'',$matches[0][0]))) ;
            $result['validity_date'] = (new \DateTimeImmutable($validity))->format($dateFormat);
        }

        if (preg_match_all("/\s{0,}Dátum\s{0,}vydania\s{0,}\/\s{0,}Date\s{0,}of\s{0,}issue\s{0,}\|\|\s{0,}[0-9]{2}\.[0-9]{2}\.[0-9]{4}\.{0,1}\s{0,}\|\|/m",$text,$matches)) {
            $issued = trim(str_replace('||','', preg_replace("/\s{0,}Dátum\s{0,}vydania\s{0,}\/\s{0,}Date\s{0,}of\s{0,}issue\s{0,}\|\|/m",'',$matches[0][0]))) ;
            $result['issue_date'] = (new \DateTimeImmutable($issued))->format($dateFormat);
        }

        if (preg_match_all("/\s{0,}Vydal\s{0,}\/\s{0,}Issued\s{0,}by\s{0,}\|\|\s{0,}[\w\s0-9A-Z\-]{1,}\s{0,}\|\|/m",$text, $matches)) {
            $result['doc_issuer'] = trim(str_replace('||','',preg_replace("/\s{0,}Vydal\s{0,}\/\s{0,}Issued\s{0,}by\s{0,}\|\|\s{0,}/m",'',$matches[0][0])));
        }

        if (preg_match_all("/\s{0,}Trvalý\s{0,}pobyt\s{0,}\/\s{0,}\|{0,}\|{0,}Address\s{0,}\|\|\s{0,}[\S\s]{1,}\s{0,}\|\|\s{0,}[\S\s]{1,}\s{0,}\|\|Rodné/m",$text, $matches)) {
            $matches[0][0] = preg_replace("/\s{0,}\|\|Rodné/m",'',preg_replace("/\s{0,}Trvalý\s{0,}pobyt\s{0,}\/\s{0,}\|{0,}\|{0,}Address\s{0,}\|\|/m",'', $matches[0][0]));
            $address = explode('||',$matches[0][0]);
            $result['perm_address'] = $address[0];
            $result['perm_town'] = $address[1];
        }

        if ($result['gender'] == 'f') {
            if (preg_match_all("/\s{0,}Rodné\s{0,}priezvisko\s{0,}\/\s{0,}[\S\s]{1,}\s{0,}\|\|\s{0,}Surname\s{0,}at\s{0,}birth\s{0,}\|\|/m",$text, $matches)) {
                $result['maiden_name'] = trim(preg_replace("/\s{0,}\|\|\s{0,}Surname\s{0,}at\s{0,}birth\s{0,}\|\|/m",'',preg_replace("/\s{0,}Rodné\s{0,}priezvisko\s{0,}\/\s{0,}/m",'',$matches[0][0])));
            }
        } else {
            $result['maiden_name'] = $result['name_last'];
        }

        if (preg_match_all("/\s{0,}Miesto\s{0,}narodenia\s{0,}\/\s{0,}[\S\s]{1,}\s{0,}\|\|\s{0,}P/m",$text, $matches)) {
            $result['birth_place'] = trim(preg_replace("/\s{0,}\|\|P/m",'',preg_replace("/\s{0,}Miesto\s{0,}narodenia\s{0,}\//m",'',$matches[0][0])));
        }

        return $result;
    }

    public function process()
    {
        $text = "";
        $result = [];

        $text .= $this->annotateText($this->images['predna']);
        $text .= $this->annotateText($this->images['zadna']);

        $result[] = ["note"=>$text];

        $text = $this->processText($text);

        $result = array_merge($result, $text);

        return $result;
    }

    private function processText($details)
    {
        $arr = explode("\n",$details);
        $result = [];
        $datNarodenia = false;
        $rodCislo = false;

        for($i=0;$i<count($arr);$i++) {
            if (strpos($arr[$i],"Priezvisko") !== false) {
                ++$i;
                $result['priezvisko'] = $arr[$i];
            }
            if (strpos($arr[$i],"Meno") !== false) {
                ++$i;
                $result['meno'] = $arr[$i];
            }
            if (strpos($arr[$i],"Dátum narodenia") !== false) {
                ++$i;
                $datNarodenia = true;
                while(strpos($arr[$i],'Rodné číslo') === false && $datNarodenia) {
                    if ($arr[$i] == 'SVK') {
                        ++$i;
                        continue;
                    }
                    preg_match('/[0-9]{1,2}\.[0-9]{1,2}\.[0-9]{4}/', $arr[$i], $output_array);
                    if (!empty($output_array)) {
                        $result['datum_narodenia'] = (new \DateTimeImmutable($output_array[0]))->format("Y-m-d");
                        $datNarodenia = false;
                    }
                    ++$i;
                }
            }
            if (strpos($arr[$i],"Rodné číslo") !== false) {
                $rodCislo = true;
                ++$i;
                while(strpos($arr[$i],'číslo') === false && $rodCislo) {
                    preg_match('/[0-9]{6}\/[0-9]{3,4}/', $arr[$i], $output_array);
                    if (!empty($output_array)) {
                        $result['rodne_cislo'] = str_replace("/","",$output_array[0]);
                        $rodCislo = false;
                    }
                    ++$i;
                }
            }

            if (strpos($arr[$i],"L") !== false && $i > 0) {
                ++$i;
                while(strpos($arr[$i],"SK") === false) {

                    if (
                        strpos($arr[$i],"Trvaly pobyt") !== false ||
                        strpos($arr[$i],"Trvalý pobyt") !== false ||
                        strpos($arr[$i], "Address") !== false
                    ) {
                        ++$i;
                        continue;
                    }
                    if (Mesto::isMesto($arr[$i])) {
                        $result['mesto'] = $arr[$i];
                        $result['mesto_id'] = Mesto::getId($arr[$i]);
                        $result['psc'] = Mesto::getPsc($arr[$i]);
                    } else {
                        $result['ulica'] = $arr[$i];
                    }
                    ++$i;
                }
            }

            if (strpos($arr[$i],"Rodné priezvisko/") !== false) {
                list($label,$meno) = explode("/",$arr[$i]);
                $result['rodne_priezvisko'] = trim($meno);
                unset($meno,$label);
            }
            if (strpos($arr[$i],"Osobitné záznamy") !== false) {
                list($label,$meno) = explode("/", $arr[$i]);
                $degree = AcademicDegrees::findOne(['short_name'=>trim($meno)]);
                if ($degree) {
                    $result['titul_pred'] = $degree->before_name == 1 ? trim($meno) : "";
                    $result['titul_pred_id'] = $degree->before_name == 1 ? $degree->id : 0;
                    $result['titul_za'] = $degree->after_name == 1 ? trim($meno) : "";
                    $result['titul_za_id'] = $degree->after_name == 1 ? $degree->id : 0;
                }
                unset($degree);
            }
            $result['sex'] = $arr[36][7] == "M" ? 1 : 0;
        }

        return $result;
    }
}