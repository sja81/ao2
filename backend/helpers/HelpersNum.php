<?php
namespace backend\helpers;


class   HelpersNum
{
    public static function getPageNumber(int $total, int $limit): int
    {
        return (int)(ceil($total/$limit));
    }

    public static function getPhoneFromStr(string $str)
    {
        return str_replace(","," ",$str);
    }

    public static function moneyFormat(?float $data, int $precision = 2, $decimalSeparator=',', $thousandSeparator=' ')
    {
        return number_format($data,$precision,$decimalSeparator,$thousandSeparator);
    }
}