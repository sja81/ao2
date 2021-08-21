<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Html;

class Aoreal extends Model
{
    public $copyright = array();
    public $company_name;
    public $address;
    public $city;
    public $postcode;
    public $phone;
    public $phone_link;
    public $email;
    public $facebook;
    public $instagram;
    public $linkedin;
    public $twitter;
    public $gmap_api_key;
    public $place_types;

    public function __construct()
    {
        $this->copyright = array('name' => 'ManDesign', 'url' => '//www.mandesign.sk/');

        $this->company_name = 'ALPHA-OMEGA REAL & CONSULTING s. r. o.';
        $this->address = 'Černyševského 10';
        $this->city = 'Bratislava - m.č. Petržalka';
        $this->postcode = '851 01';
        $this->phone = '+421 948 00 99 89';
        $this->phone_link = str_replace(array('+',' '), array('00', ''), $this->phone);
        $this->email = 'info@aoreal.sk';
        $this->facebook = 'https://www.facebook.com/Aoreal-335956663895256/';
        $this->instagram = 'https://www.instagram.com/balazs.szabo.aoreal.consulting/';
        $this->linkedin = 'https://www.linkedin.com/company/alpha-omega-real-consulting-s-r-o/';
        $this->twitter = 'https://twitter.com/omega_real';
        $this->gmap_api_key = 'AIzaSyDdy0rot-7mCKdXkOYjoGtBn4ye50L1tv0';
        $this->place_types = array(
            'airport'                   => 'Letisko',
            'bank'                      => 'Banka',
            'city_hall'                 => 'Radnica',
            'grocery_or_supermarket'    => 'Potraviny / Supermarket',
            'gym'                       => 'Telocvičňa',
            'hospital'                  => 'Nemocnica',
            'museum'                    => 'Múzeum',
            'pharmacy'                  => 'Lekáreň',
            'police'                    => 'Polícia',
            'post_office'               => 'Pošta',
            'restaurant'                => 'Reštaurácia',
            'school'                    => 'Škola',
            'train_station'             => 'Železničná stanica',
            'university'                => 'Univerzita'
        );
    }

    public static function trans ($string)
    {
        return $string;
    }

    public function encode_email($e)
    {
        $output = '';
        for ($i = 0; $i < strlen($e); $i++)
        {
            $output .= '&#'.ord($e[$i]).';';
        }
        return $output;
    }

    public static function pageAlias()
    {
        return array(
            'sk' => array(
                // O nas
                'makleri'                   => array('agents',       'Náš tím'),
                'makler-szabo-balazs'       => array('page',       'Szabó Balázs'),
                'kariera'                   => array('page',       'Kariéra'),
                'referencie'                => array('page',       'Referencie'),
                'partneri'                  => array('page',       'Partneri'),
                'media'                     => array('page',       'Media'),
                // Nehnutelnosti
                'nehnutelnosti'             => array('properties',  'Nehnuteľnosti'),
                'exkluzivne-ponuky'         => array('properties',  'Exkluzívne ponuky'),
                'najnovsie-ponuky'          => array('properties',  'Najnovšie ponuky'),
                'nehnutelnost'              => array('property',    NULL),
                //'hladam'                    => array('contact',     'Hľadám'),
                'ponukam'                   => array('contact',     'Ponúknite nám Vašu nehnutelnosť'),
                // Financne poradenstvo
                'financne-poradenstvo'      => array('page',       'Finančné poradenstvo'),            
                // Obchodne podmienky
                'reklamacny-poriadok'       => array('page',        'Reklamačný poriadok'),
                'eticky-kodex'              => array('page',        'Etický kódex'),
                'cennik'                    => array('page',        'Cenník'),
                'ochrana-osobnych-udajov'   => array('page',        'GDPR'),
				'cookie-policy'				=> array('page',        'Cookie policy'),
				'hypokalkulacka'			=> array('page',        'Hypokalkulačka'),
				'rezervacia-terminu'		=> array('page',        'Rezervácia termínu'),
                'all-inclusive-service'     => array('page',        'All-Inclusive Service'),
                // Kontakt
                'kontakt'                   => array('contact',     'Kontaktujte nás')
            ),
            'hu' => array(
                'arlista'      => 'pricelist'
            )
        );
    }

    public static function str2url($str)
    {
        $array_str = array();
        $allow_accented_chars = false;
        static $has_mb_strtolower = null;

        if ($has_mb_strtolower === null) {
            $has_mb_strtolower = function_exists('mb_strtolower');
        }

        if (isset($array_str[$str])) {
            return $array_str[$str];
        }

        if (!is_string($str)) {
            return false;
        }

        if ($str == '') {
            return '';
        }

        $return_str = trim($str);

        if ($has_mb_strtolower) {
            $return_str = mb_strtolower($return_str, 'utf-8');
        }
        if (!$allow_accented_chars) {
            $return_str = self::replaceAccentedChars($return_str);
        }

        // Remove all non-whitelist chars.
        if ($allow_accented_chars) {
            $return_str = preg_replace('/[^a-zA-Z0-9\s\'\:\/\[\]\-\p{L}]/u', '', $return_str);
        } else {
            $return_str = preg_replace('/[^a-zA-Z0-9\s\'\:\/\[\]\-]/', '', $return_str);
        }

        $return_str = preg_replace('/[\s\'\:\/\[\]\-]+/', ' ', $return_str);
        $return_str = str_replace(array(' ', '/'), '-', $return_str);

        // If it was not possible to lowercase the string with mb_strtolower, we do it after the transformations.
        // This way we lose fewer special chars.
        if (!$has_mb_strtolower) {
            $return_str = self::strtolower($return_str);
        }

        $array_str[$str] = $return_str;
        return $return_str;
    }

    public static function replaceAccentedChars($str)
    {
        /* One source among others:
            http://www.tachyonsoft.com/uc0000.htm
            http://www.tachyonsoft.com/uc0001.htm
            http://www.tachyonsoft.com/uc0004.htm
        */
        $patterns = array(

            /* Lowercase */
            /* a  */ '/[\x{00E0}\x{00E1}\x{00E2}\x{00E3}\x{00E4}\x{00E5}\x{0101}\x{0103}\x{0105}\x{0430}\x{00C0}-\x{00C3}\x{1EA0}-\x{1EB7}]/u',
            /* b  */ '/[\x{0431}]/u',
            /* c  */ '/[\x{00E7}\x{0107}\x{0109}\x{010D}\x{0446}]/u',
            /* d  */ '/[\x{010F}\x{0111}\x{0434}\x{0110}]/u',
            /* e  */ '/[\x{00E8}\x{00E9}\x{00EA}\x{00EB}\x{0113}\x{0115}\x{0117}\x{0119}\x{011B}\x{0435}\x{044D}\x{00C8}-\x{00CA}\x{1EB8}-\x{1EC7}]/u',
            /* f  */ '/[\x{0444}]/u',
            /* g  */ '/[\x{011F}\x{0121}\x{0123}\x{0433}\x{0491}]/u',
            /* h  */ '/[\x{0125}\x{0127}]/u',
            /* i  */ '/[\x{00EC}\x{00ED}\x{00EE}\x{00EF}\x{0129}\x{012B}\x{012D}\x{012F}\x{0131}\x{0438}\x{0456}\x{00CC}\x{00CD}\x{1EC8}-\x{1ECB}\x{0128}]/u',
            /* j  */ '/[\x{0135}\x{0439}]/u',
            /* k  */ '/[\x{0137}\x{0138}\x{043A}]/u',
            /* l  */ '/[\x{013A}\x{013C}\x{013E}\x{0140}\x{0142}\x{043B}]/u',
            /* m  */ '/[\x{043C}]/u',
            /* n  */ '/[\x{00F1}\x{0144}\x{0146}\x{0148}\x{0149}\x{014B}\x{043D}]/u',
            /* o  */ '/[\x{00F2}\x{00F3}\x{00F4}\x{00F5}\x{00F6}\x{00F8}\x{014D}\x{014F}\x{0151}\x{043E}\x{00D2}-\x{00D5}\x{01A0}\x{01A1}\x{1ECC}-\x{1EE3}]/u',
            /* p  */ '/[\x{043F}]/u',
            /* r  */ '/[\x{0155}\x{0157}\x{0159}\x{0440}]/u',
            /* s  */ '/[\x{015B}\x{015D}\x{015F}\x{0161}\x{0441}]/u',
            /* ss */ '/[\x{00DF}]/u',
            /* t  */ '/[\x{0163}\x{0165}\x{0167}\x{0442}]/u',
            /* u  */ '/[\x{00F9}\x{00FA}\x{00FB}\x{00FC}\x{0169}\x{016B}\x{016D}\x{016F}\x{0171}\x{0173}\x{0443}\x{00D9}-\x{00DA}\x{0168}\x{01AF}\x{01B0}\x{1EE4}-\x{1EF1}]/u',
            /* v  */ '/[\x{0432}]/u',
            /* w  */ '/[\x{0175}]/u',
            /* y  */ '/[\x{00FF}\x{0177}\x{00FD}\x{044B}\x{1EF2}-\x{1EF9}\x{00DD}]/u',
            /* z  */ '/[\x{017A}\x{017C}\x{017E}\x{0437}]/u',
            /* ae */ '/[\x{00E6}]/u',
            /* ch */ '/[\x{0447}]/u',
            /* kh */ '/[\x{0445}]/u',
            /* oe */ '/[\x{0153}]/u',
            /* sh */ '/[\x{0448}]/u',
            /* shh*/ '/[\x{0449}]/u',
            /* ya */ '/[\x{044F}]/u',
            /* ye */ '/[\x{0454}]/u',
            /* yi */ '/[\x{0457}]/u',
            /* yo */ '/[\x{0451}]/u',
            /* yu */ '/[\x{044E}]/u',
            /* zh */ '/[\x{0436}]/u',

            /* Uppercase */
            /* A  */ '/[\x{0100}\x{0102}\x{0104}\x{00C0}\x{00C1}\x{00C2}\x{00C3}\x{00C4}\x{00C5}\x{0410}]/u',
            /* B  */ '/[\x{0411}]/u',
            /* C  */ '/[\x{00C7}\x{0106}\x{0108}\x{010A}\x{010C}\x{0426}]/u',
            /* D  */ '/[\x{010E}\x{0110}\x{0414}]/u',
            /* E  */ '/[\x{00C8}\x{00C9}\x{00CA}\x{00CB}\x{0112}\x{0114}\x{0116}\x{0118}\x{011A}\x{0415}\x{042D}]/u',
            /* F  */ '/[\x{0424}]/u',
            /* G  */ '/[\x{011C}\x{011E}\x{0120}\x{0122}\x{0413}\x{0490}]/u',
            /* H  */ '/[\x{0124}\x{0126}]/u',
            /* I  */ '/[\x{0128}\x{012A}\x{012C}\x{012E}\x{0130}\x{0418}\x{0406}]/u',
            /* J  */ '/[\x{0134}\x{0419}]/u',
            /* K  */ '/[\x{0136}\x{041A}]/u',
            /* L  */ '/[\x{0139}\x{013B}\x{013D}\x{0139}\x{0141}\x{041B}]/u',
            /* M  */ '/[\x{041C}]/u',
            /* N  */ '/[\x{00D1}\x{0143}\x{0145}\x{0147}\x{014A}\x{041D}]/u',
            /* O  */ '/[\x{00D3}\x{014C}\x{014E}\x{0150}\x{041E}]/u',
            /* P  */ '/[\x{041F}]/u',
            /* R  */ '/[\x{0154}\x{0156}\x{0158}\x{0420}]/u',
            /* S  */ '/[\x{015A}\x{015C}\x{015E}\x{0160}\x{0421}]/u',
            /* T  */ '/[\x{0162}\x{0164}\x{0166}\x{0422}]/u',
            /* U  */ '/[\x{00D9}\x{00DA}\x{00DB}\x{00DC}\x{0168}\x{016A}\x{016C}\x{016E}\x{0170}\x{0172}\x{0423}]/u',
            /* V  */ '/[\x{0412}]/u',
            /* W  */ '/[\x{0174}]/u',
            /* Y  */ '/[\x{0176}\x{042B}]/u',
            /* Z  */ '/[\x{0179}\x{017B}\x{017D}\x{0417}]/u',
            /* AE */ '/[\x{00C6}]/u',
            /* CH */ '/[\x{0427}]/u',
            /* KH */ '/[\x{0425}]/u',
            /* OE */ '/[\x{0152}]/u',
            /* SH */ '/[\x{0428}]/u',
            /* SHH*/ '/[\x{0429}]/u',
            /* YA */ '/[\x{042F}]/u',
            /* YE */ '/[\x{0404}]/u',
            /* YI */ '/[\x{0407}]/u',
            /* YO */ '/[\x{0401}]/u',
            /* YU */ '/[\x{042E}]/u',
            /* ZH */ '/[\x{0416}]/u');

            // ö to oe
            // å to aa
            // ä to ae

        $replacements = array(
                'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 'ss', 't', 'u', 'v', 'w', 'y', 'z', 'ae', 'ch', 'kh', 'oe', 'sh', 'shh', 'ya', 'ye', 'yi', 'yo', 'yu', 'zh',
                'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'V', 'W', 'Y', 'Z', 'AE', 'CH', 'KH', 'OE', 'SH', 'SHH', 'YA', 'YE', 'YI', 'YO', 'YU', 'ZH'
            );

        return preg_replace($patterns, $replacements, $str);
    }

    public static function strtolower($str)
    {
        if (is_array($str)) {
            return false;
        }
        if (function_exists('mb_strtolower')) {
            return mb_strtolower($str, 'utf-8');
        }
        return strtolower($str);
    }

    public static function displayPrice($price, $decimals = 2)
    {
        if (!$price || $price <= 0)
            return false;
        return number_format((float)$price, ($price > 10000 ? 0 : $decimals),",",".") . ' €';
    }
    public static function getCountries($status = false)
    {
        $countries = Yii::$app->db->createCommand('
            SELECT * FROM `stat`
            WHERE 1'.($status ? ' AND `status` = 1' : '')
        )->queryAll();
        
        return (sizeof($countries) ? $countries : false);
    }

    public static function getRegions($country_id = null, $status = false)
    {
        $regions = Yii::$app->db->createCommand('
            SELECT r.*, c.`name` AS country_name
            FROM `kraj` r
            LEFT JOIN `stat` c ON (r.`country_id` = c.`id`)
            WHERE 1'
                .($status ? ' AND r.`status` = 1' : '')
                .(!is_null($country_id) && $country_id > 0 ? ' AND r.`country_id` = '.(int)$country_id : '').'
            ORDER BY r.`country_id` ASC, r.`name` ASC'
        )->queryAll();
        
        return (sizeof($regions) ? $regions : false);
    }

    public static function getDistricts($region_id = null, $status = false)
    {
        $districts = Yii::$app->db->createCommand('
            SELECT d.*, r.`name` AS region_name
            FROM `okres` d
            LEFT JOIN `kraj` r ON (d.`region_id` = r.`id`)
            WHERE 1'
                .($status ? ' AND d.`status` = 1' : '')
                .(!is_null($region_id) && $region_id > 0 ? ' AND d.`region_id` = '.(int)$region_id : '').'
            ORDER BY d.`region_id` ASC, d.`name` ASC'
        )->queryAll();
        
        return (sizeof($districts) ? $districts : false);
    }

    public static function getTowns($district_id = null, $region_id = null, $status = false)
    {
        if (!$district_id && !$region_id)
            return false;

        $towns = Yii::$app->db->createCommand('
            SELECT *, `nazov_obce` AS name FROM `mesto`
            WHERE 1'
                .(!is_null($district_id) && $district_id > 0 ? ' AND `okres_id` = '.(int)$district_id : '')
                .(!is_null($region_id) && $region_id > 0 ? ' AND `kraj_id` = '.(int)$region_id : '')                        
                .($status ? ' AND `status` = 1' : '')
        )->queryAll();
        
        return (sizeof($towns) ? $towns : false);
    }

    public static function getTownsByChar($q)
    {
        if (!$q)
            return false;

        $list = Yii::$app->db->createCommand("
            SELECT 
                m.id, 
                CONCAT(m.nazov_obce,' (okr. ',o.name,' / ',s.`iso_kod`,')') AS obec 
            FROM 
                mesto m 
            JOIN 
                okres o ON m.okres_id=o.id 
            JOIN
                stat s ON m.stat_id=s.id
            WHERE 
                m.nazov_obce LIKE '%{$q}%'
        ")->queryAll();

        $result = [];
        foreach($list as $item) {
            $result[$item['id']] = $item['obec'];
        }
        
        //return ['status'=>'ok','items'=>$result];
        
        return (sizeof($result) ? $result : false);
    }

    public static function getUcels($active = true)
    {
        $result = Yii::$app->db->createCommand('
            SELECT `id` AS id_ucel, `name` FROM `ucel`
            WHERE 1'                  
                .($active ? ' AND `status` = 1' : '')
        )->queryAll();
        
        return (sizeof($result) ? $result : false);
    }

    public static function getCategories($active = true)
    {
        $result = Yii::$app->db->createCommand('
            SELECT `id` AS id_category, `nazov` AS name
            FROM `nehnut_kategoria`
            WHERE 1'                  
                .($active ? ' AND `status` = 1' : '')
        )->queryAll();

        return (sizeof($result) ? $result : false);
    }

    public static function getSubCategories($id_category_parent, $active = true)
    {
        $result = Yii::$app->db->createCommand('
            SELECT `id` AS id_category, `nazov` AS name
            FROM `nehnut_druh`
            WHERE `kategoria_id` = '.(int)$id_category_parent
                .($active ? ' AND `status` = 1' : '').'
            ORDER BY `nazov` ASC'
        )->queryAll();

        return (sizeof($result) ? $result : false);
    }

    public static function getKonfiguraciaKategorie($active = true)
    {
        $result = Yii::$app->db->createCommand('
            SELECT `id` AS id_conf_category, `nazov` AS name
            FROM `konfiguracia_kategorie`
            WHERE 1'
                .($active ? ' AND `status` = 1' : '').'
            ORDER BY `nazov` ASC'
        )->queryAll();

        return (sizeof($result) ? $result : false);
    }

    public static function getKonfiguracia($id_conf_category, $active = true)
    {
        $result = Yii::$app->db->createCommand('
            SELECT `id` AS id_conf, `nazov` AS name
            FROM `konfiguracia`
            WHERE `kategoria_id` = '.(int)$id_conf_category
                .($active ? ' AND `status` = 1' : '').'
            ORDER BY `nazov` ASC'
        )->queryAll();

        return (sizeof($result) ? $result : false);
    }

    public static function getProperty($id_property)
    {
        $show_county = true;
        $show_country = false;

        $property = Yii::$app->db->createCommand('
            SELECT 
                z.`cislo` AS zmluva_cislo, zc.`zmluva_id`, zc.`cena` AS price,
                n.*, n.`id` AS id_property, 
                nd.`nazov` AS prop_category_name,
                u.`id` AS prop_type_id, u.`name` AS prop_type_name
            FROM `zmluva_nehnut` zn
            LEFT JOIN `zmluva` z ON (zn.`zmluva_id` = z.`id`)
            LEFT JOIN `zmluva_ucel` zu ON (zn.`zmluva_id` = zu.`zmluva_id`)
            LEFT JOIN `zmluva_cena` zc ON (zn.`zmluva_id` = zc.`zmluva_id`)
            LEFT JOIN `ucel` u ON (zu.`ucel_id` = u.`id`)
            LEFT JOIN `nehnutelnost` n ON (zn.`nehnut_id` = n.`id`)
            LEFT JOIN `nehnut_druh` nd ON (n.`druh_nehnut` = nd.`id`)
            WHERE n.`id` = '.(int)$id_property.' AND zu.`ucel_id` > 0 AND zc.`cena` > 0
            GROUP BY zu.`zmluva_id`, zc.`zmluva_id`
            LIMIT 1'
        )->queryAll();
        
        foreach ($property as &$row)
        {
            $street = array();
            if (!empty($row['ulica']))
                $street[] = $row['ulica'];
            if (!empty($row['supis_cis']))
                $street[] = $row['supis_cis'];
            if (!empty($row['orient_cisl']))
                $street[] = '/ '.$row['orient_cisl'];

            $row['title']           = $row['prop_category_name'].' na '.mb_strtolower($row['prop_type_name']);
            $row['street']          = implode(' ', $street);
            $row['address_full']    = (count($street) ? implode(' ', $street).', ' : '').$row['psc'].' '.$row['mesto'].($show_county ? ', '.$row['kraj'] : '').($show_country ? ', '.$row['stat'] : '');
            $row['features']        = self::getPropertyFeatures((int)$row['id_property']);
            $row['cover']           = self::getImages($row['zmluva_id'], true);
            $row['rewrite_url']     = $row['id_property'].'-'.self::str2url($row['title']).'.html';
        }

        return (sizeof($property) ? $property[0] : false);
    }

    public static function getProperties($exclusive = false, $newest = false, $page = 0, $limit = 24, $filterArray = array())
    {
        $show_county = true;
        $show_country = false;
        $interval_newest = 120;

        $properties = Yii::$app->db->createCommand('
            SELECT 
                z.`cislo` AS zmluva_cislo, zc.`zmluva_id`, zc.`cena` AS price,
                n.*, n.`id` AS id_property, 
                nd.`nazov` AS prop_category_name,
                u.`id` AS prop_type_id, u.`name` AS prop_type_name,
                DATEDIFF(n.`created_at`, DATE_SUB("'.date('Y-m-d').' 00:00:00", INTERVAL '.$interval_newest.' DAY)) > 0 AS new
            FROM `zmluva_nehnut` zn
            LEFT JOIN `zmluva` z ON (zn.`zmluva_id` = z.`id`)
            LEFT JOIN `zmluva_ucel` zu ON (zn.`zmluva_id` = zu.`zmluva_id`)
            LEFT JOIN `zmluva_cena` zc ON (zn.`zmluva_id` = zc.`zmluva_id`)
            LEFT JOIN `ucel` u ON (zu.`ucel_id` = u.`id`)
            LEFT JOIN `nehnutelnost` n ON (zn.`nehnut_id` = n.`id`)
            LEFT JOIN `nehnut_druh` nd ON (n.`druh_nehnut` = nd.`id`)
            WHERE 1 
                AND zu.`ucel_id` > 0 
                AND zc.`cena` > 0'
                .($exclusive ? ' AND n.`exclusive` = 1' : '')
                .($newest ? ' AND n.`created_at` > "'.date('Y-m-d', strtotime('-'.$interval_newest.' DAY')).'"' : '').'
            GROUP BY zu.`zmluva_id`, zc.`zmluva_id`
            ORDER BY zc.`cena` ASC
            LIMIT '.($page * $limit).', '.(($page * $limit) + $limit)
        )->queryAll();
        
        foreach ($properties as &$row)
        {
            $street = array();
            if (!empty($row['ulica']))
                $street[] = $row['ulica'];
            if (!empty($row['supis_cis']))
                $street[] = $row['supis_cis'];
            if (!empty($row['orient_cisl']))
                $street[] = '/ '.$row['orient_cisl'];

            $row['title']           = $row['prop_category_name'].' na '.mb_strtolower($row['prop_type_name']);
            $row['street']          = implode(' ', $street);
            $row['address_full']    = (count($street) ? implode(' ', $street).', ' : '').$row['psc'].' '.$row['mesto'].($show_county ? ', '.$row['kraj'] : '').($show_country ? ', '.$row['stat'] : '');
            $row['features']        = self::getPropertyFeatures((int)$row['id_property']);
            $row['cover']           = self::getImages($row['zmluva_id'], true);
            $row['rewrite_url']     = $row['id_property'].'-'.self::str2url($row['title']).'.html';
        }

        return (sizeof($properties) ? $properties : false);
    }

    public static function getPropertyFeatures($id_property)
    {
        $features = Yii::$app->db->createCommand('
            SELECT *
            FROM `nehnut_zaklady`
            WHERE `nehnut_id` = '.(int)$id_property.'
            LIMIT 1'
        )->queryAll();

        return (sizeof($features) ? $features[0] : false);
    }

    public static function getPropertiesForMap($property_type = null)
    {
        $result = array();

        if ($property_type == 'exclusive')
            return self::getProperties($property_type);
        else
        {
            $newest = ($property_type == 'newest' ? true : false);
            // Exclusive
            $exclusive_properties = self::getProperties(true, $newest);

            foreach ($exclusive_properties as $exclusive_property)
            {
                if (empty($exclusive_property['gps_lat']) || empty($exclusive_property['gps_long']))
                    continue;

                if (!isset($result['ex1-'.$exclusive_property['gps_lat'].'-'.$exclusive_property['gps_long']]))
                    $result['ex1-'.$exclusive_property['gps_lat'].'-'.$exclusive_property['gps_long']] = $exclusive_property;
            }
            
            // Other
            $other_properties = self::getProperties(false, $newest);

            foreach ($other_properties as $other_property)
            {
                if (empty($other_property['gps_lat']) || empty($other_property['gps_long']))
                    continue;
                
                if (!isset($result['ex0-'.$other_property['gps_lat'].'-'.$other_property['gps_long']]))
                    $result['ex0-'.$other_property['gps_lat'].'-'.$other_property['gps_long']] = $other_property;
            }
            
            foreach ($result as $gps_location => &$row)
            {
                $gpsloc = explode('-',$gps_location);
                $properties_by_gps = self::getPropertiesUrlByGps($gpsloc[1], $gpsloc[2]);

                $row['total_results'] = self::getPropertiesTotal(false, $newest, $gps_location);
                $row['properties_by_gps'] = $properties_by_gps;
                
                $row['properties_by_gps_html'] = '';
                foreach ($properties_by_gps as $property_by_gps)
                    $row['properties_by_gps_html'] .= '<li><a href="https://www.aoreal.sk/nehnutelnost/'.$property_by_gps['rewrite_url'].'">'.$property_by_gps['title'].'</a></li>';
            }
            
            return $result;
        }
    }

    public static function getPropertiesTotal($exclusive = false, $newest = false, $gps_location = NULL)
    {
        $interval_newest = 120;
        if ($gps_location)
        {
            $gpsloc = explode('-',$gps_location);
        }

        $properties = Yii::$app->db->createCommand('
            SELECT n.`id`
            FROM `zmluva_nehnut` zn
            LEFT JOIN `zmluva` z ON (zn.`zmluva_id` = z.`id`)
            LEFT JOIN `zmluva_ucel` zu ON (zn.`zmluva_id` = zu.`zmluva_id`)
            LEFT JOIN `zmluva_cena` zc ON (zn.`zmluva_id` = zc.`zmluva_id`)
            LEFT JOIN `ucel` u ON (zu.`ucel_id` = u.`id`)
            LEFT JOIN `nehnutelnost` n ON (zn.`nehnut_id` = n.`id`)
            LEFT JOIN `nehnut_druh` nd ON (n.`druh_nehnut` = nd.`id`)
            WHERE 1 
                AND zu.`ucel_id` > 0 
                AND zc.`cena` > 0'
                .($exclusive ? ' AND n.`exclusive` = 1' : '')
                .($newest ? ' AND n.`created_at` > "'.date('Y-m-d', strtotime('-'.$interval_newest.' DAY')).'"' : '')
                .($gps_location ? ' AND n.`gps_lat` = '.$gpsloc[1].' AND n.`gps_long` = '.$gpsloc[2] : '').'
            GROUP BY zu.`zmluva_id`, zc.`zmluva_id`
        ')->queryAll();
        
        return count($properties);
    }

    public static function getPropertiesUrlByGps($lat, $lng, $limit = 5, $exclusive = false, $newest = false)
    {
        if (!$lat || !$lng || empty($lat) || empty($lng))
            return false;

        $interval_newest = 120;

        $properties = Yii::$app->db->createCommand('
            SELECT 
                z.`cislo` AS zmluva_cislo, zc.`zmluva_id`, zc.`cena` AS price,
                n.*, n.`id` AS id_property, 
                nd.`nazov` AS prop_category_name,
                u.`id` AS prop_type_id, u.`name` AS prop_type_name,
                DATEDIFF(n.`created_at`, DATE_SUB("'.date('Y-m-d').' 00:00:00", INTERVAL '.$interval_newest.' DAY)) > 0 AS new
            FROM `zmluva_nehnut` zn
            LEFT JOIN `zmluva` z ON (zn.`zmluva_id` = z.`id`)
            LEFT JOIN `zmluva_ucel` zu ON (zn.`zmluva_id` = zu.`zmluva_id`)
            LEFT JOIN `zmluva_cena` zc ON (zn.`zmluva_id` = zc.`zmluva_id`)
            LEFT JOIN `ucel` u ON (zu.`ucel_id` = u.`id`)
            LEFT JOIN `nehnutelnost` n ON (zn.`nehnut_id` = n.`id`)
            LEFT JOIN `nehnut_druh` nd ON (n.`druh_nehnut` = nd.`id`)
            WHERE 1 
                AND n.`gps_lat` LIKE "'.$lat.'" AND n.`gps_long` LIKE "'.$lng.'"
                AND zu.`ucel_id` > 0 
                AND zc.`cena` > 0'
                .($exclusive ? ' AND n.`exclusive` = 1' : '')
                .($newest ? ' AND n.`created_at` > "'.date('Y-m-d', strtotime('-'.$interval_newest.' DAY')).'"' : '').'
            GROUP BY zu.`zmluva_id`, zc.`zmluva_id`
            ORDER BY zc.`cena` ASC
            LIMIT '.$limit
        )->queryAll();

        foreach ($properties as &$row)
        {
            $row['title']           = $row['prop_category_name'].' na '.mb_strtolower($row['prop_type_name']);
            $row['rewrite_url']     = $row['id_property'].'-'.self::str2url($row['title']).'.html';
        }

        return (sizeof($properties) ? $properties : false);
    }

    public static function getImages($zmluva_id, $cover = false)
    {
        $siteurl = Yii::$app->urlManager->createAbsoluteUrl(['/']);

        $images = Yii::$app->db->createCommand('
            SELECT `obrazok`, `zmluva_cislo`
            FROM `nehnut_obrazky`
            WHERE `zmluva_id` = '.(int)$zmluva_id.' AND `status` = 1
            '.($cover ? 'LIMIT 1' : '')
        )->queryAll();

        foreach ($images as &$row)
        {
            $image_file = 'content/'.$row['zmluva_cislo'].'/images/'.$row['obrazok'];
            if (file_exists($_SERVER['DOCUMENT_ROOT'].'frontend/web/'.$image_file))
            {
                $image_size = getimagesize($_SERVER['DOCUMENT_ROOT'].'frontend/web/'.$image_file);
                $row['path'] = $siteurl.$image_file;
                $row['aspect-ratio'] = $image_size[0] / $image_size[1];
            }
            else
            {
                $row['path'] = false;
                $row['aspect-ratio'] = false;
            }
        }
        return (sizeof($images) ? ($cover ? $images[0] : $images) : false);
    }

    public static function getGmapApiKey()
    {
        $aoreal = new Aoreal();
        return $aoreal->gmap_api_key;
    }
    public static function getPlaceTypes()
    {
        $aoreal = new Aoreal();
        return $aoreal->place_types;
    }
    public static function saveNearbyPlaces($id_nehnutelnost, $gps_lat, $gps_long, $check_poi = true)
    {
        if (empty($gps_lat) || empty($gps_long))
            return false;

        $gMapApiKey = Aoreal::getGmapApiKey();
        $placeTypes = Aoreal::getPlaceTypes();
        $radius_values = array(500,1000,2500,5000);

        if ($check_poi)
        {
            $poi_exists = Yii::$app->db->createCommand('SELECT `id_nehnut_lokalita` FROM `nehnut_lokalita` WHERE `id_nehnutelnost` = '.(int)$id_nehnutelnost)->queryAll();
            if ($poi_exists && sizeof($poi_exists))
                return false;
        }

        $places = array();
        foreach ($placeTypes as $placeType => $placeTypeName)
        {
            $poi_saved = false;

            foreach ($radius_values as $radius)
            {
                if ($poi_saved)
                    continue;

                $nearbyPlaces = json_decode(file_get_contents('https://maps.googleapis.com/maps/api/place/nearbysearch/json?location='.$gps_lat.','.$gps_long.'&radius='.$radius.'&type='.$placeType.'&language=sk&key='.$gMapApiKey));

                if ($nearbyPlaces->results && sizeof($nearbyPlaces->results))
                {
                    foreach($nearbyPlaces->results as $placeDetails)
                    {
                        if ($placeDetails->business_status == 'OPERATIONAL')
                        {
                            $row_data = array(
                                'id_nehnutelnost'   => (int)$id_nehnutelnost,
                                'name'          => $placeDetails->name,
                                'type'          => $placeType,
                                'description'   => '{"vicinity" : "'.$placeDetails->vicinity.'"}',
                                'gps_lat'       => $placeDetails->geometry->location->lat,
                                'gps_lng'       => $placeDetails->geometry->location->lng,
                                'radius'        => $radius,
                                'distance_by_car'	=> NULL,
								'distance_by_walk'	=> NULL
                            );
                            Yii::$app->db->createCommand()->insert('nehnut_lokalita', $row_data)->execute();

                            $places[] = $row_data;
                            $poi_saved = true;
                        }
                    }
                }
            }
        }
        return $places;
    }

	public static function savePoiDistanceByProperty($id_nehnutelnost, $gps_lat, $gps_long)
	{
		$gMapApiKey = Aoreal::getGmapApiKey();
		$nearbyPlaces = Yii::$app->db->createCommand('
			SELECT * FROM `nehnut_lokalita`
			WHERE `id_nehnutelnost` = '.(int)$id_nehnutelnost.'
				AND `gps_lat` != "" AND `gps_lng` != ""
				AND (`distance_by_car` = "" OR `distance_by_car` IS NULL)
			ORDER BY `type`
		')->queryAll();

		foreach ($nearbyPlaces as $nearbyPlace)
		{
			$distanceByCar = json_decode(file_get_contents('https://maps.googleapis.com/maps/api/distancematrix/json?origins='.$gps_lat.','.$gps_long.'&destinations='.$nearbyPlace['gps_lat'].','.$nearbyPlace['gps_lng'].'&mode=driving&language=sk-SK&key='.$gMapApiKey));
			
			if (isset($distanceByCar->rows[0]->elements[0]) && $distanceByCar->rows[0]->elements[0]->status == 'OK')
			{
				$distanceObj = $distanceByCar->rows[0]->elements[0];

				$row_data = array(
					'distance_by_car'	=> $distanceObj->distance->value,
					'duration_by_car'	=> $distanceObj->duration->value
				);

				Yii::$app->db->createCommand()->update('nehnut_lokalita', $row_data, 'id_nehnut_lokalita = '.(int)$nearbyPlace['id_nehnut_lokalita'])->execute();
			}
			else
				return false;

			//$distanceByWalk = json_decode(file_get_contents('https://maps.googleapis.com/maps/api/distancematrix/json?origins='.$gps_lat.','.$gps_long.'&destinations='.$nearbyPlace['gps_lat'].','.$nearbyPlace['gps_lng'].'&mode=walking&language=sk-SK&key='.$gMapApiKey));
		}
	}

    public static function getNearbyPlaces($id_nehnutelnost, $count = false, $order_by = NULL)
    {
        $placeTypes = Aoreal::getPlaceTypes();
        $radius_values = array(500,1000,2500,5000);
        $places = array();

        foreach ($radius_values as $radius)
        {
            $nearbyPlaces = Yii::$app->db->createCommand('
				SELECT * FROM `nehnut_lokalita` 
				WHERE `id_nehnutelnost` = '.(int)$id_nehnutelnost.' 
					AND `radius` = '.$radius.'
				ORDER BY '.(!is_null($order_by) ? $order_by : '`distance_by_car` ASC'))->queryAll();

            $place_type = NULL;
            if ($nearbyPlaces)
            {
                foreach ($nearbyPlaces as $place)
                {
                    if ($count)
                    {
                        if ($place_type != $place['type'])
                        {
                            $place_count = Yii::$app->db->createCommand('
                                SELECT COUNT(`id_nehnutelnost`) AS count_places FROM `nehnut_lokalita`
                                WHERE `id_nehnutelnost` = '.(int)$id_nehnutelnost.' AND `radius` = '.$radius.' AND `type` = "'.$place['type'].'"
                                LIMIT 1'
                            )->queryAll();
                            $count_places = ($place_count && isset($place_count[0])) ? (int)$place_count[0]['count_places'] : 0;
                            $places[] = array(
								'type' => $place['type'], 
								'name' => $placeTypes[$place['type']],
								'radius' => $radius, 
								'count' => $count_places
							);
                        }
                    }
                    else
                        $places[] = array(
							'type' => $place['type'], 
							'name' => $place['name'], 
							'radius' => $radius, 
							'gps_lat' => $place['gps_lat'], 
							'gps_lng' => $place['gps_lng'],
							'distance_by_car'	=> $place['distance_by_car'],
							'duration_by_car'	=> $place['duration_by_car']
						);

                    $place_type = $place['type'];
                }
            }
        }

        return $places;
    }

    public static function displayImage($image)
    {
        return (!$image || ($image && !$image['path'])) ? Yii::$app->urlManager->createAbsoluteUrl(['/']).'images/property-fullwidth1.jpg' : $image['path'];
    }

    public static function getMainMenu($menuItems, $menu_id = 'navigation')
    {
        $html = '';

        if (isset($menuItems) && count($menuItems))
        {
            $html .= '
            <ul id="'.$menu_id.'" class="menu">';
            foreach ($menuItems as $menuItem)
            {
                $hasChildren = (isset($menuItem['submenu']) && count($menuItem['submenu']));

                $html .= '
                <li class="menu-item menu-item-type-post_type menu-item-object-page'.($hasChildren ? ' menu-item-has-children':'').'">'
                    .($menuItem['url'] != '#' ? Html::a($menuItem['label'], $menuItem['url'], array('data-title' => $menuItem['label'])) : '<span class="menu-item">'.$menuItem['label'].'</span>');

                    if (isset($menuItem['submenu']) && count($menuItem['submenu']))
                    {
                        $html .= '
                        <ul class="sub-menu">';
                        foreach ($menuItem['submenu'] as $smItem)
                        {
                            $html .= '
                            <li class="menu-item menu-item-type-post_type menu-item-object-page">'.Html::a($smItem['label'], $smItem['url'], array('data-title' => $smItem['label'])).'</li>';
                        }
                        $html .= '
                        </ul>';
                    }
                $html .= '
                </il>';
            }
            $html .= '
            </ul>';
        } 
        return $html;
    }

    public static function getMaxMinValuesForSearch()
    {
        $sizes = Yii::$app->db->createCommand('SELECT MAX(`plocha_celkova`) AS size_max, MIN(`plocha_celkova`) AS size_min FROM `nehnut_zaklady`')->queryOne();
        $prices = Yii::$app->db->createCommand('SELECT MAX(`cena`) AS price_max, MIN(`cena`) AS price_min FROM `zmluva_cena` WHERE `status` = 1')->queryOne();
        
        return array(
            'min_sizefrom'  => (int)floor($sizes['size_min']),
            'max_sizefrom'  => (int)ceil($sizes['size_max']),
            'min_sizeto'    => (int)floor($sizes['size_min']),
            'max_sizeto'    => (int)ceil($sizes['size_max']),
            'min_pricefrom' => (int)floor($prices['price_min']),
            'max_pricefrom' => (int)ceil($prices['price_max']),
            'min_priceto'   => (int)floor($prices['price_min']),
            'max_priceto'   => (int)ceil($prices['price_max']),
        );
    }

    public static function htmlSearchBlock($sizefrom = null, $sizeto = null, $pricefrom = null, $priceto = null)
    {
        $maxminValues = self::getMaxMinValuesForSearch();

        $html = '
        <section class="section-filter">
            <header class="section-heading">
                <h2>'.Aoreal::trans('Vyhľadávanie').'</h2>
            </header>
            <div class="section-content">
                <form name="searchProperty" action="'.Yii::$app->urlManager->createAbsoluteUrl(['/nehnutelnosti']).'" method="get" class="filter-form">
                    <input type="hidden" name="search" value="">
                    <input type="text" name="fulltext" value="" placeholder="'.Aoreal::trans('Názov alebo č. zákazky...').'">

                    <select class="js-filter-form-select" data-placeholder="'.Aoreal::trans('Typ').'" name="type[]" multiple="multiple">';
                    $ucels = self::getUcels();
                    foreach ($ucels as $ucel)
                        $html .= '<option value="'.$ucel['id_ucel'].'">'.$ucel['name'].'</option>';
        // KATEGORIAK            
        $html .= '
                    </select>
                    <select class="js-filter-form-select" data-placeholder="'.Aoreal::trans('Druh').'" name="category[]" multiple="multiple">';
                    $main_categs = self::getCategories();
                    $id_parent_category = 0;
                    $count_main_categs = count($main_categs);

                    foreach ($main_categs as $nr_categ => $main_categ)
                    {
                        if ($id_parent_category == 0)
                            $html .= '
                            <optgroup label="'.mb_strtoupper($main_categ['name'], 'UTF-8').'">';
                        elseif ($id_parent_category > 0 && $id_parent_category != $main_categ['id_category'])
                            $html .= '
                            </optgroup>
                            <optgroup label="'.mb_strtoupper($main_categ['name'], 'UTF-8').'">';

                        $sub_categs = self::getSubCategories($main_categ['id_category']);
                        foreach ($sub_categs as $sub_categ)
                        {
                            $html .= '
                                <option value="'.$sub_categ['id_category'].'">'.$sub_categ['name'].'</option>';
                        }
                        
                        $id_parent_category = $main_categ['id_category'];
                        
                        if (($nr_categ + 1) == $count_main_categs)
                           $html .= '
                           </optgroup>'; 
                    }
        // KONFIGURACIOK - FULL
        /*$html .= '
                    </select>
                    <select name="configs">
                        <option selected>'.Aoreal::trans('Stav').'</option>';
                    $conf_categs = self::getKonfiguraciaKategorie();
                    $id_conf_category = 0;
                    $count_conf_categs = count($conf_categs);

                    foreach ($conf_categs as $nr_categ => $conf_categ)
                    {
                        if ($id_conf_category == 0)
                            $html .= '
                            <optgroup label="'.mb_strtoupper($conf_categ['name'], 'UTF-8').'">';
                        elseif ($id_conf_category > 0 && $id_conf_category != $conf_categ['id_conf_category'])
                            $html .= '
                            </optgroup>
                            <optgroup label="'.mb_strtoupper($conf_categ['name'], 'UTF-8').'">';

                        $sub_conf_categs = self::getKonfiguracia($conf_categ['id_conf_category']);
                        foreach ($sub_conf_categs as $sub_conf_categ)
                        {
                            $html .= '
                                <option value="'.$sub_conf_categ['id_conf'].'">'.$sub_conf_categ['name'].'</option>';
                        }
                        
                        $id_conf_category = $conf_categ['id_conf_category'];
                        
                        if (($nr_categ + 1) == $count_conf_categs)
                           $html .= '
                           </optgroup>'; 
                    }*/
        // KONFIGURACIOK - STAV OBJEKTOV
        $html .= '
                    </select>
                    <select class="js-filter-form-select" data-placeholder="'.Aoreal::trans('Stav').'" name="state[]" multiple="multiple">';
                        $conf_states = self::getKonfiguracia(10);
                        foreach ($conf_states as $conf_state)
                        {
                            $html .= '
                            <option value="'.(int)$conf_state['id_conf'].'">'.$conf_state['name'].'</option>';
                        }
        $html .= '
                    </select>';
        // COUNTRY | REGION | AREA | CITY
                    // START >> lepcsozetes megoldas
                    /*$country_id = 1;
                    $regions = Aoreal::getRegions($country_id, true);
                    if ($regions)
                    {
                        $html .= '
                        <select id="filter-region" name="region_id" data-action="getDisctrictsByRegion" data-field="#filter-district">
                            <option value="" selected>'.Aoreal::trans('Kraj').'</option>';

                            foreach ($regions as $region)
                                $html .= '
                                <option value="'.$region['id'].'">'.$region['name'].'</option>';

                        $html .= '
                        </select>';
                    }
        $html .= '
                    <select id="filter-district" name="district_id" data-action="getTownsByDistrict" data-field="#filter-town" disabled>
                        <option value="" selected>'.Aoreal::trans('Okres').'</option>
                    </select>
                    <select id="filter-town" name="town_id" disabled>
                        <option value="" selected>'.Aoreal::trans('Mesto / obec').'</option>
                    </select>';*/
                    // END >> lepcsozetes megoldas
                    /*$countries = Aoreal::getCountries(true);
                    if ($countries)
                    {
                        $html .= '
                        <select class="js-filter-form-select" data-placeholder="'.Aoreal::trans('Štáty').'" name="countries[]" multiple="multiple">';
                        foreach ($countries as $country)
                        {
                            $html .= '
                            <option value="'.$country['id'].'">'.$country['name'].'</option>';
                        }
                        $html .= '
                        </select>';
                    }*/
                    $regions = Aoreal::getRegions(null, true);
                    if ($regions)
                    {
                        $html .= '
                        <select class="js-filter-form-select" data-placeholder="'.Aoreal::trans('Kraj').'" name="regions[]" multiple="multiple">';

                        $country_name = NULL;
                        $count_regions = count($regions);
                        foreach ($regions as $nr_region => $region)
                        {
                            if (is_null($country_name))
                                $html .= '
                                <optgroup label="'.mb_strtoupper($region['country_name'], 'UTF-8').'">';
                            elseif (!is_null($country_name) && $country_name != $region['country_name'])
                                $html .= '
                                </optgroup>
                                <optgroup label="'.mb_strtoupper($region['country_name'], 'UTF-8').'">';
                            
                            $html .= '
                            <option value="'.$region['id'].'">'.$region['name'].'</option>';
                            
                            $country_name = $region['country_name'];
                            
                            if (($nr_region + 1) == $count_regions)
                                $html .= '
                                </optgroup>'; 
                        }

                        $html .= '
                        </select>';
                    }
        
                    $districts = Aoreal::getDistricts(null, true);
                    if ($districts)
                    {
                        $html .= '
                        <select class="js-filter-form-select" data-placeholder="'.Aoreal::trans('Okres').'" name="districts[]" multiple="multiple">';

                        $region_name = NULL;
                        $count_districts = count($districts);
                        foreach ($districts as $nr_district => $district)
                        {
                            if (is_null($region_name))
                                $html .= '
                                <optgroup label="'.mb_strtoupper($district['region_name'], 'UTF-8').'">';
                            elseif (!is_null($region_name) && $region_name != $district['region_name'])
                                $html .= '
                                </optgroup>
                                <optgroup label="'.mb_strtoupper($district['region_name'], 'UTF-8').'">';
                            
                            $html .= '
                            <option value="'.$district['id'].'">'.$district['name'].'</option>';
                            
                            $region_name = $district['region_name'];
                            
                            if (($nr_district + 1) == $count_districts)
                                $html .= '
                                </optgroup>'; 
                        }

                        $html .= '
                        </select>';
                    }
        $html .= '
                    <select class="js-filter-form-select" name="Search[m][]" id="filter-city" multiple="multiple"></select>';
        
        // ROOMS
        $html .= '
                    <select class="js-filter-form-select" data-placeholder="'.Aoreal::trans('Počet miestností').'" name="rooms[]" multiple="multiple">';
                    for ($rooms = 1; $rooms <= 20; $rooms++)
                    {
                        $html .= '<option value="'.$rooms.'">'.$rooms.' '.($rooms == 1 ? Aoreal::trans('miestnosť') : Aoreal::trans('miestností')).'</option>';
                    }
        $html .= '
                    </select>
                    <select class="js-filter-form-select" data-placeholder="'.Aoreal::trans('Počet kúpelní').'" name="bathrooms[]" multiple="multiple">';
                    for ($bathrooms = 1; $bathrooms <= 5; $bathrooms++)
                    {
                        $html .= '<option value="'.$bathrooms.'">'.$bathrooms.' '.($bathrooms == 1 ? Aoreal::trans('kúpelňa') : Aoreal::trans('kúpelní')).'</option>';
                    }
        $html .= '
                    </select>

                    <div class="size-filter-block">
                        <label for="filter-size">'.Aoreal::trans('Výmera v').' m<sup>2</sup></label>
                        <input type="text" name="sizefrom" id="min-slider-value-size" data-number-min="'.$maxminValues['min_sizefrom'].'" data-number-max="'.$maxminValues['max_sizefrom'].'" value="'.(!is_null($sizefrom) ? $sizefrom : $maxminValues['min_sizefrom']).'" placeholder="'.Aoreal::trans('Výmera od v m2').'">
                        <input type="text" name="sizeto" id="max-slider-value-size" data-number-min="'.$maxminValues['min_sizeto'].'" data-number-max="'.$maxminValues['max_sizeto'].'" value="'.(!is_null($sizeto) ? : $maxminValues['max_sizeto']).'" placeholder="'.Aoreal::trans('Výmera do v m2').'">
                        <input type="text" id="filter-size" class="show-values show-tooltip" value="" data-slider-min="'.$maxminValues['min_sizeto'].'" data-slider-max="'.$maxminValues['max_sizeto'].'" data-slider-step="10" data-slider-value="['.$maxminValues['min_sizeto'].','.$maxminValues['max_sizeto'].']">
                    </div>
                    <div class="price-filter-block">
                        <label for="filter-price">'.Aoreal::trans('Cena od-do').'</label>
                        <input type="text" name="'.(!is_null($pricefrom) > 0 ? $pricefrom : $maxminValues['min_pricefrom']).'" id="min-slider-value" data-number-min="'.$maxminValues['min_pricefrom'].'" data-number-max="'.$maxminValues['max_pricefrom'].'" value="'.$pricefrom.'" placeholder="'.Aoreal::trans('Cena od').'">
                        <input type="text" name="priceto" id="max-slider-value" data-number-min="'.$maxminValues['min_priceto'].'" data-number-max="'.$maxminValues['max_priceto'].'" value="'.(!is_null($priceto) ? $priceto : $maxminValues['max_priceto']).'" placeholder="'.Aoreal::trans('Cena do').'">
                        <input type="text" id="filter-price" class="show-values show-tooltip" value="" data-slider-min="'.$maxminValues['min_priceto'].'" data-slider-max="'.$maxminValues['max_priceto'].'" data-slider-step="1000" data-slider-value="['.$maxminValues['min_priceto'].','.$maxminValues['max_priceto'].']">
                    </div>
                    <button class="btn btn-primary" type="submit" value="'.Aoreal::trans('Nájsť ponuky').'">'.Aoreal::trans('Hľadať').'</button>
                </form>
            </div>
        </section>';
        
        return $html;
    }

    public static function getBaliky($active = true)
    {
        $baliky = Yii::$app->db->createCommand('SELECT *, `nazov` AS nazov_balik FROM `baliky` WHERE `status` = '.(int)$active)->queryAll();
        
        foreach ($baliky as &$row)
        {
            $baliky_polozkyArray = array();
            $baliky_polozky = Yii::$app->db->createCommand('SELECT `nazov` FROM `baliky_polozky` WHERE `status` = '.(int)$active.' AND `balik_id` = '.(int)$row['id'])->queryAll();
            foreach ($baliky_polozky as $baliky_polozka)
            {
                $baliky_polozkyArray[] = $baliky_polozka['nazov'];
            }
            $row['polozky'] = $baliky_polozkyArray;
        }

        return (sizeof($baliky) ? $baliky : false);
    }
}
