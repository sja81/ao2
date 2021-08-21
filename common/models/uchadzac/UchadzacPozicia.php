<?php
namespace common\models\uchadzac;

use common\models\Applications;
use yii\db\ActiveRecord;

class UchadzacPozicia extends ActiveRecord
{
    const PENDING = 'pend';
    const IN_PROGRESS = 'inprog';
    const CLOSED = 'closed';

    private $statusArr = [
        'pend'   => 'čaká sa',
        'inprog' => 'prebieha',
        'closed' => 'uzavreté'
    ];

    private $sourceArr = [
        'facebook'  => 'Facebook',
        'upsvar'    => 'Úrad práce',
        'twitter'   => 'Twitter',
        'bazos'     => 'Bazos.sk',
        'profesia'  => 'Profesia.sk'
    ];

    public static function tableName()
    {
        return 'uchadzac_pozicia';
    }

    public function getInfo()
    {
        return $this->hasOne(Applications::class,['id'=>'pozicia_id']);
    }

    public function getStatusText()
    {
        return $this->statusArr[$this->status];
    }

    public function getSourceText()
    {
        return $this->sourceArr[$this->adv_source];
    }
}