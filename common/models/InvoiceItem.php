<?php
namespace common\models;

use yii\db\ActiveRecord;

class InvoiceItem extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'faktura_polozky';
    }

    public function attributeLabels()
    {
        return [
            'id'    => 'ID',
            'faktura_id'  =>  'Faktura ID',
            'polozka_id' => 'Polozka ID',
            'popis_polozky' => 'Popis polozky',
            'datum_realizacie' => 'Datum realizacie',
            'polozka_text'  => 'Polozka text',
            'merna_jednotka' => 'Merna jednotka',
            'mnozstvo' => 'Mnozstvo',
            'cena' => 'Cena',
            'total_cena' => 'Cena spolu',
            'dph'  => 'DPH',
            'total_dph' => 'DPH spolu',
            'cena_s_dph' => 'Cena s DPH',
            'total_cena_s_dph' => 'Cena spolu s DPH',
            'status'  =>  'Status',
        ];
    }
}