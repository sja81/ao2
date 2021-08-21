<?php
namespace common\models\sys;

use Yii;

class SysLog
{
    // LOG TYPES
    const LT_ERROR = "ERR";
    const LT_INFO = "INFO";

    public static function WriteError($pid, $className, $message, $row = null)
    {
        $vals = [
            "pid"           => "'{$pid}'",
            "class_name"    => "'{$className}'",
            "class_row"     => $row ?? 0,
            "log_type"      => "'".static::LT_ERROR."'",
            "data"          => "'{$message}'"
        ];
        $vals = implode(",",$vals);
        $q = "INSERT INTO sys_log VALUES (NULL,{$vals},NULL)";
        Yii::$app->db->createCommand($q)->execute();
    }

    public static function WriteInfo($pid, $className, $message, $row = null)
    {
        $vals = [
            "pid"           => "'{$pid}'",
            "class_name"    => "'{$className}'",
            "class_row"     => $row ?? 0,
            "log_type"      => "'".static::LT_INFO."'",
            "data"          => "'{$message}'"
        ];
        $vals = implode(",",$vals);
        $q = "INSERT INTO sys_log VALUES (NULL,{$vals},NULL)";
        Yii::$app->db->createCommand($q)->execute();
    }
}