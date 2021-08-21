<?php
namespace common\models\documents\search;

use Yii;

class Search
{
    private $sterm = null;

    public function setSearchTerm($sterm)
    {
        $this->sterm = $sterm;
    }

    public function execute()
    {
        if ($this->sterm == '') {
            return [];
        }
        $q = "SELECT id, `name` FROM template WHERE CAST(content AS BINARY) REGEXP '\\\[[a-z._]{0,}" . $this->sterm . "[a-z._]{0,}\\\]' AND deleted_at IS null";
        return Yii::$app->db->createCommand($q)->queryAll();
    }
}