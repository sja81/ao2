<?php
namespace common\models\reader;

use Yii;

class LVReader
{
    protected $texts = [];
    protected $result = [];
    protected $zakaznikPointer = 0;

    public function __construct(array $data)
    {
        $this->texts = $data;
        $this->result = [
            "KRAJINA"       => "",
            "KRAJ"          => "",
            "PSC"           => "",
        ];
    }

    public function process()
    {
        throw new Exception("Toto musi byt naimplementovane v potomku!!!");
    }

    public function getResult()
    {
        return $this->result;
    }

    protected function correctString($str)
    {
        $correction = [
            "È" => "Č",
            "è" => "č",
            "¾" => "ľ",
            "ò" => "ň"
        ];

        return str_replace(array_keys($correction),$correction,$str);
    }

    protected function getLVCislo(int $i)
    {
        if (strpos($this->texts[$i], "VÝPIS Z LISTU VLASTNÍCTVA") !== FALSE) {
            $this->result["LV"] =  abs((int) filter_var($this->texts[$i], FILTER_SANITIZE_NUMBER_INT));
        }
    }

    protected function getOkres(int &$i)
    {
        if (strpos($this->texts[$i],"Okres") !== FALSE) {
            $i += 2;
            $this->result["OKRES_CISLO"] = $this->texts[$i];
            ++$i;
            $this->result["OKRES_TEXT"]= $this->correctString($this->texts[$i]);
        }
    }

    protected function getObec(int &$i)
    {
        if (strpos($this->texts[$i],"Obec") !== FALSE) {
            $i += 2;
            $this->result["OBEC_CISLO"] = $this->texts[$i];
            ++$i;
            $this->result["OBEC_TEXT"] = $this->correctString($this->texts[$i]);
        }
    }

    protected function getKatastralneUzemie(int &$i)
    {
        if (strpos($this->texts[$i],"Katastrálne územie") !== FALSE) {
            $i += 2;
            $this->result["KU_KOD"] = $this->texts[$i];
            ++$i;
            $this->result["KU_TEXT"] = $this->correctString($this->texts[$i]);
        }
    }

    protected function getOsobaTyp($meno)
    {
        return strpos($meno, "IČO:") === false ? "FYZ" : "PODN";
    }

    protected function hasBSM ($text)
    {
        return strpos($text, ", BSM") !== false ? 'A' : 'N';
    }

    protected function hasPsc($text)
    {
        if (strpos($text,"PSČ") === false) {
            return false;
        }
        $text = trim(str_replace(" ","", $text));
        $text = str_replace("PSČ","", $text);
        return $text;
    }

    protected function hasStat($text, &$id, &$nazov)
    {
        $sql = "SELECT id,`name` FROM stat where `name` like '%{$text}%' or iso_kod like '%{$text}%' or kod like '%{$text}%'";
        $result = Yii::$app->db->createCommand($sql)->queryOne();

        if (is_array($result)) {
            $id = $result['id'];
            $nazov = $result['name'];
            return count($result);
        }
        return false;
    }

    protected function hasMesto($text, &$id, &$nazov)
    {
        $text = trim($text," |&!");

        $sql = "SELECT id,nazov_obce  FROM mesto where nazov_obce='{$text}'";

        $result = Yii::$app->db->createCommand($sql)->queryOne();

        if (is_array($result)) {
            $id = $result['id'];
            $nazov = $result['nazov_obce'];
            return count($result);
        }
        return false;
    }

    protected function getMenoOsoby($meno)
    {
        $result = [];

        $osoba = explode(" ",$meno);

        $result["PRIEZVISKO"] = trim($osoba[0]);
        $krstneMeno = [];
        $rodMeno = [];

        for($i=1; $i < count($osoba);$i++) {
            if ($osoba[$i] == 'r.') {
                $i++;
                break;
            }
            array_push($krstneMeno, trim($osoba[$i]));
        }

        if ($i != count($osoba)) {
            for ($j=$i; $j < count($osoba);$j++) {
                array_push($rodMeno,$osoba[$j]);
            }
        }

        $result["MENO"] = trim(implode(" ",$krstneMeno));
        $result["ROD_MENO"] = trim(implode(" ",$rodMeno));

        return $result;
    }

    protected function getBsmMajitel($text, int $poradie)
    {
        $result = [];

        $text = str_replace(", BSM","",$text);

        $pos = strrpos($text, "Dátum narodenia: ");
        $result[0]['DATUM'] = trim(str_replace("Dátum narodenia:","", substr($text,$pos)));
        $text = substr($text,0, $pos);
        $pos = strrpos($text, "Dátum narodenia: ");
        $result[1]['DATUM'] = trim(str_replace("Dátum narodenia:","", substr($text,$pos)),"\t\n\r ,\0");
        $text = substr($text,0, $pos);

        $names = explode(",",$text);

        foreach($names as $key => $item) {
            $item = trim($item);

            if (($psc = $this->hasPsc($item)) !== false) {
                $result[0]["PSC"] = $result[1]["PSC"] = $psc;
                unset($names[$key]);
            }

            if ($this->hasStat($item, $statId, $statNazov)) {
                $result[0]["STAT"] = $result[1]["STAT"] = $statNazov;
                $result[0]["STAT_ID"] = $result[1]["STAT_ID"] = $statId;
                unset($names[$key]);
            }

            if ($this->hasMesto($item,$mestoId, $mestoNazov )) {
                $result[0]["MESTO"] = $result[1]["MESTO"] = $mestoNazov;
                $result[0]["MESTO_ID"] = $result[1]["MESTO_ID"] = $mestoId;
                unset($names[$key]);
            }
        }

        $result[0]["ULICA"] = $result[1]["ULICA"] = trim(end($names));

        if (count($names)>1) {
            array_pop($names);
        }

        $meno = implode(" ",$names);

        unset($names);

        $this->fixNameIssues($meno);

        list($osoba1,$osoba2) = explode(" a ",$meno);

        $result[0] = array_merge($result[0],$this->getMenoOsoby($osoba2));
        $result[1] = array_merge($result[1],$this->getMenoOsoby($osoba1));

        $result = array_reverse($result);

        return count($result) > 0 ? $result[$poradie-1] : [];

    }

    protected function fixNameIssues(&$meno)
    {
        $meno = str_replace("|","",$meno);
        $meno = str_replace(",","",$meno);
    }

    protected function isMajitelRiadok ($text)
    {
        preg_match('/^[0-9]{1,}$/', $text, $output);
        return count($output) > 0;
    }

    protected function isVlastnickyPodiel ($text)
    {
        preg_match('/^[0-9]{1,}\/[0-9]{1,}$/', $text, $output);
        return count($output) > 0;
    }

    /**
     * @param string $meno
     * @return array
     */
    protected function getPodnikatel($meno)
    {
        $result = [];
        $names = explode(',', $meno);

        $result["MESTO"] = trim($names[2]);
        $result["NAZOV"] = trim($names[0]);
        $result["ADRESA1"] = trim($names[1]);

        foreach($names as $item) {
            if (strpos($item, "PSČ") !== false) {
                $item = str_replace("PSČ","",$item);
                $item = str_replace(" ","", $item);
                $result["PSC"] = trim($item);
            }
            if (strpos($item, "IČO:") !== false) {
                $item = str_replace("IČO:","",$item);
                $item = str_replace(" ","", $item);
                $result["ICO"] = trim($item);
            }
        }

        return $result;
    }


    protected function getMajitel($meno)
    {
        $result = [];

        $pos = strrpos($meno, "Dátum narodenia: ");
        $result['DATUM'] = trim(str_replace("Dátum narodenia:","", substr($meno,$pos)));

        $meno = substr($meno,0, $pos);

        $names = explode(',', $meno);

        foreach($names as $key => $item) {
            $item = trim($item);

            if (strlen($item) == 0) {
                unset($names[$key]);
                continue;
            }

            if (($psc = $this->hasPsc($item)) !== false) {
                $result["PSC"] = $psc;
                unset($names[$key]);
            }

            if ($this->hasStat($item, $statId, $statNazov)) {
                $result["STAT"] = $statNazov;
                $result["STAT_ID"] = $statId;
                unset($names[$key]);
            }

            if ($this->hasMesto($item,$mestoId, $mestoNazov )) {
                $result["MESTO"]= $mestoNazov;
                $result["MESTO_ID"] = $mestoId;
                unset($names[$key]);
            }
        }

        $result["ULICA"] = trim(end($names));

        array_pop($names);

        $result = array_merge($result, $this->getMenoOsoby(implode(" ",$names)));

        return $result;
    }

}