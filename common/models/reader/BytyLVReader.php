<?php
namespace common\models\reader;

class BytyLVReader extends LVReader
{

    public function process()
    {
        $byty = [];
        $bytPointer = -1;
        $spracovanieMajitelov = false;
        $pageBrake = false;
        $pocetBytov = 0;

        for($i=0; $i < count($this->texts);$i++) {

            $this->getLVCislo($i);
            $this->getOkres($i);
            $this->getObec($i);
            $this->getKatastralneUzemie($i);

            $this->getParcelneCislo($i);

            $this->getPocetBytov($i);

            if (strpos($this->texts[$i],"Vchod (èíslo)") !== FALSE ) {

                ++$bytPointer; // nasiel sa novy byt
                ++$i;
                $this->zakaznikPointer = 0;
                $spracovanieMajitelov = false;
                ++$pocetBytov;

                $vchod = $this->texts[$i];

                if($vchod == "Poschodie") {
                    $pageBrake = true;
                    continue;
                } else {
                    $pageBrake = false;
                }

                if (is_numeric($vchod)) {
                    $byty[$bytPointer]["VCHOD"] = $vchod;
                } else {
                    $vchod = explode(" ",$vchod);
                    $byty[$bytPointer]["VCHOD"] = $vchod[1] ?? -100;
                    $byty[$bytPointer]["ULICA"] = $vchod[0] ?? "ULICA";
                }

            }

            if (strpos($this->texts[$i],"Poschodie") !== FALSE && !$pageBrake) {

                ++$i;
                $poschodieArray = [];

                if ($this->texts[$i] == "prízemie") {
                    $poschodieArray[0] = 0;
                    $poschodieArray[1] = "prízemie";
                } else {
                    $poschodieArray = preg_split('/\s/', $this->texts[$i]);
                }
                $byty[$bytPointer]["POSCHODIE"] = $poschodieArray[0];
                $byty[$bytPointer]["POSCHODIE_TEXT"] = isset($poschodieArray[1]) ? $poschodieArray[1] : '';

            }

            if (strpos($this->texts[$i],"Èíslo bytu") !== FALSE && !$pageBrake) {
                ++$i;
                $byty[$bytPointer]["CISLO_BYT"] = $this->texts[$i];
            }

            if (strpos($this->texts[$i],"Súpisné èíslo") !== FALSE && !$pageBrake) {
                ++$i;
                $byty[$bytPointer]["SUPIS_CISLO"] = $this->texts[$i];
            }

            if (strpos($this->texts[$i],"Podiel priestoru na spoloèných") !== FALSE && !$pageBrake) {
                do {
                    ++$i;
                    preg_match('/^[0-9]{1,}\/[0-9]{1,}$/', $this->texts[$i], $output);
                } while (empty($output));
                $byty[$bytPointer]["CELKOVA_POLCHA"] = (explode("/",$this->texts[$i]))[0];
            }

            if (strpos($this->texts[$i],"Spoluvlastnícky") !== FALSE && !$pageBrake) {
                $i += 2;
                $spracovanieMajitelov = true;
            }

            if ($this->isMajitelRiadok($this->texts[$i]) && $spracovanieMajitelov && !$pageBrake) {

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
                        $byty[$bytPointer]["MAJITEL"][$this->zakaznikPointer] = [
                            "NADOBUDNUTE"   => $nadobudnute,
                            "PODIEL"        => $podiel,
                            "POPIS"         => $meno,
                            "INFO"          => $this->getBsmMajitel($meno,1),
                            "BSM"           => 'A',
                            "OSOBA_TYP"     => $osobaTyp
                        ];
                        ++$this->zakaznikPointer;
                        $byty[$bytPointer]["MAJITEL"][$this->zakaznikPointer] = [
                            "NADOBUDNUTE"   => $nadobudnute,
                            "PODIEL"        => $podiel,
                            "POPIS"         => $meno,
                            "INFO"          => $this->getBsmMajitel($meno,2),
                            "BSM"           => 'A',
                            "OSOBA_TYP"     => $osobaTyp
                        ];
                    } else {
                        $byty[$bytPointer]["MAJITEL"][$this->zakaznikPointer] = [
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
                    $byty[$bytPointer]["MAJITEL"][$this->zakaznikPointer] = [
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

    private function getParcelneCislo(int &$i)
    {
        if (strpos($this->texts[$i],"Parcelné èíslo") !== FALSE) {
            $i += 16;
            $this->result["PARCELA_CISLO"] = $this->texts[$i];
        }
    }

    private function getPocetBytov(int $i)
    {
        if (strpos($this->texts[$i],"Poèet bytov:") !== FALSE) {
            $this->result['POCET_BYTOV']  = abs((int) filter_var($this->texts[$i], FILTER_SANITIZE_NUMBER_INT));
        }
    }


}