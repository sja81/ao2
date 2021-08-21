<?php
namespace common\models\reader;

use function GuzzleHttp\Psr7\str;

class DomyLVReader extends LVReader
{
    private $parcely= [];

    public function process()
    {
        $byty = [];
        $c = count($this->texts);
        $spracovanieMajitelov = false;

        for($i=0; $i < $c; $i++) {
            $this->getLVCislo($i);
            $this->getOkres($i);
            $this->getObec($i);
            $this->getKatastralneUzemie($i);
            $this->getParcely($i);


            if (strpos($this->texts[$i],"Súpisné") !== FALSE ) {
                $i += 11;
                $byty[0]["SUPIS_CISLO"] = $this->texts[$i];
                ++$i;
                $byty[0]["CELKOVA_PLOCHA"]  = $this->parcely[$this->texts[$i]];
                $this->result["PARCELA_CISLO"] = $this->texts[$i];
            }

            if (strpos($this->texts[$i],"podiel") !== FALSE) {
                $spracovanieMajitelov = true;
            }


            if ($this->isMajitelRiadok($this->texts[$i]) && $spracovanieMajitelov) {
                $meno = [];
                ++$i;

                while (!$this->isVlastnickyPodiel($this->texts[$i])) {
                    array_push ($meno,$this->texts[$i]);
                    ++$i;
                }

                $meno = $this->correctString(implode(" ", $meno));
                $podiel = $this->texts[$i];

                $i += 2;

                $nadobudnute = $this->correctString($this->texts[$i]);
                $osobaTyp = $this->getOsobaTyp($meno);

                if ($osobaTyp == 'FYZ') {
                    if ($this->hasBSM($meno) == 'A') {
                        $byty[0]["MAJITEL"][$this->zakaznikPointer] = [
                            "NADOBUDNUTE"   => $nadobudnute,
                            "PODIEL"        => $podiel,
                            "POPIS"         => $meno,
                            "INFO"          => $this->getBsmMajitel($meno,1),
                            "BSM"           => 'A',
                            "OSOBA_TYP"     => $osobaTyp
                        ];
                        ++$this->zakaznikPointer;
                        $byty[0]["MAJITEL"][$this->zakaznikPointer] = [
                            "NADOBUDNUTE"   => $nadobudnute,
                            "PODIEL"        => $podiel,
                            "POPIS"         => $meno,
                            "INFO"          => $this->getBsmMajitel($meno,2),
                            "BSM"           => 'A',
                            "OSOBA_TYP"     => $osobaTyp
                        ];
                    } else {
                        $byty[0]["MAJITEL"][$this->zakaznikPointer] = [
                            "NADOBUDNUTE"   => $nadobudnute,
                            "PODIEL"        => $podiel,
                            "POPIS"         => $meno,
                            "INFO"          => $this->getMajitel($meno),
                            "BSM"           => 'N',
                            "OSOBA_TYP"     => $osobaTyp
                        ];
                    }
                }

                if ($osobaTyp == 'PODN') {
                    $byty[0]["MAJITEL"][$this->zakaznikPointer] = [
                        "NADOBUDNUTE"   => $nadobudnute,
                        "PODIEL"        => $podiel,
                        "POPIS"          => $meno,
                        "INFO"          => $this->getPodnikatel($meno),
                        "BSM"           => 'N',
                        "OSOBA_TYP"     => $osobaTyp
                    ];
                }

                ++$this->zakaznikPointer;
            }
        }

        $this->result["BYTY"] = $byty;

        return true;
    }

    private function getParcely(int &$i) {
        if (strpos($this->texts[$i],"Parcelné èíslo") !== FALSE) {
            $i += 16;
            while($this->texts[$i] != 'Legenda') {
                preg_match('/^[0-9]{1,}\/{0,1}[0-9]{1,}$/', $this->texts[$i], $output);
                if (!empty($output)) {
                    ++$i;
                    $this->parcely[$output[0]] = $this->texts[$i];
                    do{
                        ++$i;
                    }while(strpos($this->texts[$i],"Iné údaje:") === false);
                }
                ++$i;
            }
        }
    }
}