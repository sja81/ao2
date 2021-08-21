<?php
namespace common\helpers;


final class DirectoryHelper
{
    public static function mediaDirectory()
    {
        return \Yii::getAlias('@mediadir') . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR .'..' . DIRECTORY_SEPARATOR .'media';
    }
}