<?php
namespace common\models;

use yii\db\ActiveRecord;

class InvoiceCustomer extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'faktura_odberatel';
    }

    public function attributeLabels()
    {
        return [
            'id'    => 'ID',
            'faktura_id'  =>  'Faktura ID',
            'nazov'  =>  'Nazov',
            'kontaktna_osoba'  =>  'Kontaktna osoba',
            'ulica'  =>  'Ulica',
            'mesto'  =>  'Mesto',
            'psc'  =>  'PSC',
            'stat'  =>  'Stat',
            'ico'  =>  'ICO',
            'dic'  =>  'DIC',
            'icdph'  =>  'IC DPH',
            'poznamka' => 'Poznamka',
            'dodacia'   => 'Dodacia',
            'dodacia_nazov' => 'Dodacia Nazov',
            'dodacia_kontaktna_osoba' => 'Dodacia - kontaktna osoba',
            'dodacia_ulica' => 'Dodacia - ulica',
            'dodacia_mesto' => 'Dodacia - mesto',
            'dodacia_psc' => 'Dodacia - psc',
            'dodacia_stat' => 'Dodacia - stat',
            'status'  =>  'Status',
        ];
    }
}