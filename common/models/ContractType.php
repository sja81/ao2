<?php
namespace common\models;

use Yii;

final class ContractType
{
    public function getAll()
    {
        return Yii::$app->db->createCommand("select id,`name` from contract_type")->queryAll();
    }
}