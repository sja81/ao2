<?php
namespace common\helpers;

final class TimeHelper
{
    public static function secToTime($sec): string
    {
        $h = floor($sec / 3600);
        $m = floor(($sec - $h*3600) / 60);
        $s = $sec - ($h*3600 + $m*60);

        return str_pad($h,2,'0',STR_PAD_LEFT) .
            ':' .
            str_pad($m,2,'0',STR_PAD_LEFT) .
            ':' .
            str_pad($s,2,'0',STR_PAD_LEFT);
    }
}