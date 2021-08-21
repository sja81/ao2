<?php
namespace common\models;

use yii\db\ActiveRecord;

class InvoiceSupplier extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'faktura_dodavatel';
    }

    public function attributeLabels()
    {
        return [
            'id'    => 'ID',
            'dodavatel_id' => 'Dodavetel ID',
            'faktura_id'  =>  'Faktura ID',
            'nazov'  =>  'Nazov',
            'kontaktna_osoba'  =>  'Kontaktna osoba',
            'ulica'  =>  'Ulica',
            'mesto'  =>  'Mesto',
            'psc'  =>  'PSC',
            'stat'  =>  'Stat',
            'status'  =>  'Status',
            'ico'  =>  'ICO',
            'dic'  =>  'DIC',
            'icdph'  =>  'IC DPH',
            'platca_dph'  =>  'Platca DPH',
            'info'  =>  'Informacie',
            'telefon'  =>  'Telefon',
            'email'  =>  'Email',
            'web'  =>  'Web',
            'iban'  =>  'IBAN',
            'swift'  =>  'SWIFT',
            'banka'  =>  'Banka',
        ];
    }
}