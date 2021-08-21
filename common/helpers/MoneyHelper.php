<?php


namespace common\helpers;


class MoneyHelper
{
    public static function displayMoney($amount, $decimalPlace =2, $decimalSeparator=",", $thousandSeparator=".")
    {
        return number_format($amount, $decimalPlace, $decimalSeparator, $thousandSeparator);
    }
}