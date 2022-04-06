<?php
namespace common\models\posta\slovensko\eph\xmlgenerator;

use Yii;
use common\models\posta\slovensko\eph\EphGenerator;
use common\models\settings\Settings;

class XmlGenerator extends EphGenerator
{
    private static $generatorVersion = "1.0";

    private $version = null;
    private $xmlns = null;
    private $info = null;
    private $shipments = null;

    /**
     * @param EphInfo $info
     * @param array $recipients array of EphRecipient objects
     */
    public function __construct(
        EphInfo $info,
        array $shipments
    )
    {
        $this->info = $info;
        $this->shipments = $shipments;

        $this->date = $date ?? (new \DateTimeImmutable("now"))->format("Ymd");

        $xmlSetting = Settings::get("ephxml",true);
        $this->version = $xmlSetting["version"];
        $this->xmlns = $xmlSetting["xmlns"];
    }

    public function create(): void
    {
        $this->content = "<EPH verzia=\"" . $this->version . "\" xmlns=\"" . $this->xmlns . "\">\n";
        $this->content .= "\t<InfoEPH>\n";
        $this->content .= "\t\t<Mena>{$this->info->getCurrency()}</Mena>\n";
        $this->content .= "\t\t<TypEPH>{$this->info->getEphType()}</TypEPH>\n";
        $this->content .= "\t\t<EPHID>{$this->info->getId()}</EPHID>\n";
        $this->content .= "\t\t<Datum>{$this->info->getDate()}</Datum>\n";
        $this->content .= "\t\t<PocetZasielok>". count($this->shipments) ."</PocetZasielok>\n";
        $this->content .= "\t\t<Uhrada>\n";
        $this->content .= "\t\t\t<SposobUhrady>{$this->info->getPaymentType()}</SposobUhrady>\n";
        $this->content .= "\t\t\t<SumaUhrady>0.00</SumaUhrady>\n";
        $this->content .= "\t\t</Uhrada>\n";
        $this->content .= "\t\t<DruhPPP>5</DruhPPP>\n";
        $this->content .= "\t\t<DruhZasielky>{$this->info->getShipmentType()}</DruhZasielky>\n";
        $this->content .= "\t\t<SposobSpracovania>{$this->info->getProcessType()}</SposobSpracovania>\n";
        $this->content .= "\t\t<Odosielatel>\n";
        $this->content .= "\t\t\t<OdosielatelID>{$this->info->getSender()->getId()}</OdosielatelID>\n";
        if ($this->info->getSender()->getName() === "") {
            $this->content .= "\t\t\t<Meno />\n";
        } else {
            $this->content .= "\t\t\t<Meno>{$this->info->getSender()->getName()}</Meno>\n";
        }
        if ($this->info->getSender()->getOrganization() === "") {
            $this->content .= "\t\t\t<Organizacia />\n";
        } else {
            $this->content .= "\t\t\t<Organizacia>{$this->info->getSender()->getOrganization()}</Organizacia>\n";
        }
        $this->content .= "\t\t\t<Ulica>{$this->info->getSender()->getStreet()}</Ulica>\n";
        $this->content .= "\t\t\t<Mesto>{$this->info->getSender()->getTown()}</Mesto>\n";
        $this->content .= "\t\t\t<PSC>{$this->info->getSender()->getZip()}</PSC>\n";
        $this->content .= "\t\t\t<Krajina>{$this->info->getSender()->getCountry()}</Krajina>\n";
        $this->content .= "\t\t\t<Telefon>{$this->info->getSender()->getPhone()}</Telefon>\n";
        $this->content .= "\t\t\t<Email>{$this->info->getSender()->getEmail()}</Email>\n";
        $this->content .= "\t\t\t<CisloUctu>{$this->info->getSender()->getAccountNumber()}</CisloUctu>\n";
        $this->content .= "\t\t</Odosielatel>\n";
        $this->content .= "\t</InfoEPH>\n";
        $this->content .= "\t<Zasielky>\n";
        foreach($this->shipments as $item) {
            $this->content .= "\t\t<Zasielka>\n";
            $this->content .= "\t\t\t<Adresat>\n";
            if ($item->getRecipient()->getName() === "") {
                $this->content .= "\t\t\t\t<Meno />\n";
            } else {
                $this->content .= "\t\t\t\t<Meno>{$item->getRecipient()->getName()}</Meno>\n";
            }
            if ($item->getRecipient()->getOrganization() === "") {
                $this->content .= "\t\t\t\t<Organizacia />\n";
            } else {
                $this->content .= "\t\t\t\t<Organizacia>{$item->getRecipient()->getOrganization()}</Organizacia>\n";
            }
            $this->content .= "\t\t\t\t<Ulica>{$item->getRecipient()->getStreet()}</Ulica>\n";
            $this->content .= "\t\t\t\t<Mesto>{$item->getRecipient()->getTown()}</Mesto>\n";
            $this->content .= "\t\t\t\t<PSC>{$item->getRecipient()->getZip()}</PSC>\n";
            $this->content .= "\t\t\t\t<Krajina>{$item->getRecipient()->getCountry()}</Krajina>\n";
            $this->content .= "\t\t\t</Adresat>\n";
            if ($item->isSameReturnAddress()) {
                $this->content .= "\t\t\t<Spat></Spat>\n";
            } else {
                $this->content .= "\t\t\t<Spat>\n";
                $this->content .= "\t\t\t</Spat>\n";
            }
            $this->content .= "\t\t\t<SVDSpat></SVDSpat>\n";
            $this->content .= "\t\t\t<Info>\n";
            $this->content .= "\t\t\t\t<Hmotnost>{$item->getWeight()}</Hmotnost>\n";
            $this->content .= "\t\t\t\t<Trieda>{$item->getLetterClass()}</Trieda>\n";
            $this->content .= "\t\t\t\t<ObsahZasielky>{$item->getContent()}</ObsahZasielky>\n";
            $this->content .= "\t\t\t</Info>\n";

            if (empty($item->getServices())) {
                $this->content .= "\t\t\t<PouziteSluzby />\n";
            } else {
                $this->content .= "\t\t\t<PouziteSluzby>\n";
                foreach ($item->getServices() as $service) {
                    $this->content .= "\t\t\t\t<Sluzba>{$service}</Sluzba>\n";
                }
                $this->content .= "\t\t\t</PouziteSluzby>\n";
            }
            $this->content .= "\t\t\t<DalsieUdaje></DalsieUdaje>\n";
            $this->content .= "\t\t\t<ColneVyhlasenie></ColneVyhlasenie>\n";
            $this->content .= "\t\t</Zasielka>\n";
        }
        $this->content .= "\t</Zasielky>\n";
        $this->content .= "</EPH>";

    }

    public function downloadFile(string $name): void
    {
        if (headers_sent()) {
            throw new \Exception("Data has already been sent to output, unable to output XML file");
        }

        header("Content-Description: File Transfer");
        header("Content-Transfer-Encoding: binary");
        header("Cache-Control: public, must-revalidate, max-age=0");
        header("Pragma: public");
        header("X-Generator: AOReal Backoffice " . static::$generatorVersion);
        header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Content-Type: application/xml");
        if (empty($_SERVER["HTTP_ACCEPT_ENCODING"])) {
            // don"t use length if server using compression
            header("Content-Length: " . strlen($this->content));
        }

        header('Content-Disposition: attachment; filename="' . $name . '"');

        echo $this->content;

        Yii::$app->end();

    }


}