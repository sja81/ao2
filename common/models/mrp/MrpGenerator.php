<?php

namespace common\models\mrp;

abstract class MrpGenerator
{
    protected $content = null;

    abstract public function create();
}
