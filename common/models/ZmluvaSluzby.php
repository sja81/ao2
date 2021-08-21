<?php
namespace common\models;


use yii\db\ActiveRecord;

class ZmluvaSluzby extends ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'zmluva_sluzby';
    }

    public function pridajSluzby(array $data)
    {
        $toSave = [
            'pravne_sluzby',
            'pravne_sluzby_cena',
            'reklama',
            'reklama_cena',
            'cestovne',
            'cestovne_cena',
            'sluzby_ine',
            'sluzby_ine_popis',
            'sluzby_ine_cena',
            'spravne_popl',
            'spravne_popl_cena'
        ];

        $this->zmluva_id = $data['zmluva_id'];

        foreach($toSave as $key=>$item) {
            if (in_array($item, $data)) {
                $this->$key = $data[$item];
            }
        }

        $result = $this->save();

        if (!$result) {
            throw new Exception('Nemozem ulozit informaciu o sluzbach', 401);
        }
    }

}