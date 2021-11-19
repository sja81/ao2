<?php
namespace common\models\tasks;

use yii\helpers\StringHelper;

final class TasksPriority
{
    const TRIVIAL = 'trivial';
    const MAJOR = 'major';
    const CRITICAL = 'critical';
    const BLOCKER = 'blocker';

    public static function getPriorities(): array
    {
        return [
            self::TRIVIAL       => StringHelper::mb_ucfirst(self::TRIVIAL),
            self::MAJOR         => StringHelper::mb_ucfirst(self::MAJOR),
            self::CRITICAL      => StringHelper::mb_ucfirst(self::CRITICAL),
            self::BLOCKER       => StringHelper::mb_ucfirst(self::BLOCKER)
        ];
    }
}