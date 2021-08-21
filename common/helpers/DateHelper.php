<?php
namespace common\helpers;

final class DateHelper
{
    const SHORT_FORMAT = 'Y-m-d';
    const LONG_FORMAT = 'Y-m-d H:i:s';
    const INV_FORMAT = 'd.m.Y';

    public static function getActualYear()
    {
        return (new \DateTime('now'))->format('Y');
    }

    public static function getActualMonth()
    {
        return (new \DateTime('now'))->format('m');
    }

    public static function getToday($format = 'Y-m-d')
    {
        return (new \DateTime('now'))->format($format);
    }

    public static function formatDate($date, $format='Y-m-d')
    {
        return (new \DateTime($date))->format($format);
    }
}