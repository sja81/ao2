<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

class Nehnutelnost extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nehnutelnost';
    }

    /**
     * @param array $params
     * @return mixed
     * @throws \Exception
     */
    public function pridajNehnutelnost(Array $params)
    {
        $data = $params['property'];

        $this->mesto = $data['KU_obec_nazov'];
        $this->stat = $data['country'];
        $this->kraj = $data['region'];
        $this->psc = $data['zip'];
        $this->okres = $data['KU_okres_nazov'];
        $this->created_by = Yii::$app->user->identity->id;
        $this->ulica = $data['KU_ulica'];
        $this->list_vlast = $data['list_vlast'];
        $this->supis_cis = $data['supis_cis'];
        $this->orient_cisl = $data['orient_cisl'];
        $this->cislo_byt = $data['cislo_byt'];
        $this->parc_cislo = $data['parc_cislo'];
        $this->kategoria = $data['kategoria'];
        $this->druh_nehnut = $data['druh_nehnut'];
        $this->kat_uzemie = $data['KU_uzemie_nazov'];
        $this->kat_uzemie_kod = $data['KU_uzemie_kod'];
        $this->obec_kod = $data['KU_obec_kod'];
        $this->okres_kod = $data['KU_okres_kod'];
        $this->gps_lat = $data['gps_lat'];
        $this->gps_long = $data['gps_long'];

        $res = $this->save();

        if(!$res) {
            throw new \Exception('Nehnutelnost nebol ulozeny!!!',404);
        }
    }

    public function getNehnutKategoria()
    {
        return $this->hasOne(NehnutKategoria::class,['id'=>'kategoria']);
    }

    public function getDruh()
    {
        return $this->hasOne(NehnutelnostDruhy::class,['id'=>'druh_nehnut']);
    }

    public function getNaklady()
    {
        return $this->hasMany(NehnutelnostNaklady::className(),['nehnut_id'=>'id']);
    }

    public function getZakladneInfo()
    {
        return $this->hasOne(NehnutelnostZakladneInfo::className(),['nehnut_id'=>'id']);
    }

}