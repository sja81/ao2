<?php
namespace backend\helpers;
/**
 * $Id$
 * Helper class for converting arbitrary float number to words in slovak language
 */
class HelperString{


    /**
     * Original EN implementation: http://www.karlrixon.co.uk/writing/convert-numbers-to-words-with-php/
     * @param float $number
     * @param int $units
     * @param int $level
     */
    public static function number2words($number, $units = null, $level = -1)
    {
        ++$level;
        $hyphen      = ''; // in english "-", v slovencine ziadny
        $conjunction = ' '; // in english ' and ' v slovencine nepouzivame
        $separator   = ' ';
        $negative    = 'mínus ';
        $decimal     = ' celé ';
        $dictionary  = array(
            0                   => 'nula',
            1                   => 'jeden', // jeden milion, jedna miliarda
            2                   => 'dva', // dvojtvar dve, dve - napr. 22000 - dvadsatDVA tisic, 200 = DVE sto
            3                   => 'tri',
            4                   => 'štyri',
            5                   => 'päť',
            6                   => 'šesť',
            7                   => 'sedem',
            8                   => 'osem',
            9                   => 'deväť',
            10                  => 'desať',
            11                  => 'jedenásť',
            12                  => 'dvanásť',
            13                  => 'trinásť',
            14                  => 'štrnásť',
            15                  => 'pätnásť',
            16                  => 'šestnásť',
            17                  => 'sedemnásť',
            18                  => 'osemnásť',
            19                  => 'devätnásť',
            20                  => 'dvadsať',
            30                  => 'tridsať',
            40                  => 'štyridsať',
            50                  => 'päťdesiat',
            60                  => 'šesťdesiat',
            70                  => 'sedemdesiat',
            80                  => 'osemdesiat',
            90                  => 'deväťdesiat',
            100                 => 'sto',
            1000                => 'tisíc',
            1000000             => 'milión',   // e6
            1000000000          => 'miliarda|miliardy|miliárd', // e9
            1000000000000       => 'bilión',   // e12
            1000000000000000    => 'biliarda|biliardy|biliárd', // e15
            1000000000000000000 => 'trilión',  // e18
            // https://sk.wikipedia.org/wiki/Veľké_čísla
        );

        if (!is_numeric($number)) {
            return false;
        }

        if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
            // overflow
            throw new CHttpException(500, 'Invalid number range - value must be between ' . PHP_INT_MAX . ' and ' . PHP_INT_MAX.'.');
        }

        if ($number < 0) {
            return $negative . self::number2words(abs($number));
        }

        $string = $fraction = null;

        if (strpos($number, '.') !== false) {
            list($number, $fraction) = explode('.', $number);
        }

        switch (true) {
            case $number < 21:
                $dict = $dictionary[$number];
                if($units){
                    if($number == 1){
                        // ludia chcu "jednosto"
                        $dict = ''; // nie jedentisic, jedensto
                        if($level <= 1){ // first loop = 0, pridame "jedno"sto na zaciatku slova
                            if($units == 100){
                                $dict = 'jedno'; // jednosto
                            }elseif(in_array($units, [1e3, 1e6])){
                                $dict = 'jeden'; // jedentisic
                            }elseif(in_array($units, [1e9, 1e15])){
                                $dict = 'jedna'; // jedna miliarda
                            }
                        }
                    }elseif($number == 2 && in_array($units, [1e3, 1e9, 1e15])){
                        $dict = 'dve'; // dvetisic, nie dvatisic, dve miliardy nie dva miliardy
                    }
                }
                $string = $dict;
                break;
            case $number < 100:
                $tens   = ((int) ($number / 10)) * 10;
                $units  = $number % 10;
                $string = $dictionary[$tens];
                if ($units) {
                    $string .= $hyphen . $dictionary[$units];
                }
                break;
            case $number < 1000:
                $hundreds  = floor($number / 100);
                $remainder = $number % 100;
                if($hundreds == 1){
                    // ludia chcu "jednosto"
                    $dict = ''; // nie styritisic jedenstoosemdesiat, jedenstopatnast
                    if(!$level){ // jednosto na zaciatku slova
                        $dict = $dictionary[$hundreds]; // nie styritisic jedenstoosemdesiat, jedenstopatnast
                        if($number < 200){
                            $dict = 'jedno'; // jednostodvanast, nie jedensto
                        }
                    }
                }elseif($hundreds == 2){
                    $dict = 'dve'; // dvesto, nie dvasto
                }else{
                    $dict = $dictionary[$hundreds];
                }
                $string = $dict . $dictionary[100];
                if ($remainder) {
                    $string .= self::number2words($remainder, null, $level);
                }
                break;
            default:
                $baseUnit = pow(1000, floor(log($number, 1000)));
                $numBaseUnits = (int) ($number / $baseUnit);
                $remainder = $number % $baseUnit;
                // SK declination
                $append = $dictionary[$baseUnit];
                if($baseUnit > 1000){
                    $bigNumSep = ' ';
                    // nesklonujeme tisicky, len milion a vyssie
                    if(in_array($baseUnit, [1e9, 1e15])){
                        $append = explode('|', $append);
                        if($numBaseUnits >= 2 && $numBaseUnits <= 4){
                            $append = $append[1]; // 2, 3, 4 miliardy, biliardy
                        }elseif($numBaseUnits >= 5 ){
                            $append = $append[2]; // 5,6 ... 99 miliárd, biliárd
                        }else{
                            $append = $append[0]; // 1 miliarda, 1 biliarda
                        }
                    }else{
                        if($numBaseUnits >= 2 && $numBaseUnits <= 4){
                            $append .= 'y'; // 2, 3, 4 miliony, biliony, triliony, ..
                        }elseif($numBaseUnits >= 5 ){
                            $append .= 'ov'; // 5,6 ... 99 milionov
                        }
                    }
                }else{
                    $bigNumSep = '';
                }
                $string = self::number2words($numBaseUnits, $baseUnit, $level) . $bigNumSep . $append;
                if ($remainder) {
                    $string .= $remainder < 100 ? $conjunction : $separator;
                    $string .= self::number2words($remainder, null, $level);
                }
                break;
        }

        if (null !== $fraction && is_numeric($fraction) && 0 != $fraction) {
            $string .= $decimal;
            $words = array();
            foreach (str_split((string) $fraction) as $number) {
                $words[] = $dictionary[$number];
            }
            $string .= implode('', $words);
        }

        return $string;
    }
}