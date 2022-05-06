<?php
namespace common\models\posta\slovensko\eph;

abstract class EphGenerator
{
    protected $content = null;

    abstract public function create();
}