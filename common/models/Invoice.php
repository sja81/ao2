<?php
namespace common\models;

use yii\db\ActiveRecord;

class Invoice extends ActiveRecord
{
    const PENDING = 1;
    const PAID = 2;
    const CANCLLED = 3;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'faktura';
    }

    public function attributeLabels()
    {
        return [
            'id'    => 'ID',
            'znak'  => 'Znak',
            'rok'   => 'Rok',
            'mesiac' => 'Mesiac',
            'cislo' => 'Cislo',
            'zmluva_id' => 'Zmluva ID',
            'poznamka' => 'Poznamka',
            'vystavil' => 'Vystavil',
            'datum_vystavenia' => 'Datum vystavenia',
            'datum_dodania' => 'Datum dodania',
            'splatnost' => 'Splatnost',
            'mena' => 'Mena',
            'kurz_meny' => 'Kurz meny',
            'zlava' => 'Zlava',
            'forma_uhrady' => 'Forma uhrady',
            'status' => 'Status',
            'created_at' => 'Vytvorene',
            'created_by' => 'Vytvoril',
            'typ_faktury' => 'Typ faktury',
            'suma' => 'Suma',
            'suma_s_dph' => 'Suma s DPH',
            'k_uhrade' => 'K uhrade',
            'var_symbol' => 'Variabilny symbol',
            'konst_symbol' => 'Konstantny symbol',
            'qr_kod' => 'QR kod',
            'prenesena_dan' => 'Prenesena danova povinnost'
        ];
    }

    public function getDodavatel()
    {
        return $this->hasOne(InvoiceSupplier::class,['faktura_id'=>'id']);
    }

    public function getCustomer()
    {
        return $this->hasOne(InvoiceCustomer::class,['faktura_id'=>'id']);
    }

    public function getPolozky()
    {
        return $this->hasMany(InvoiceItem::class,['faktura_id'=>'id']);
    }

    public function isAfterDueDate()
    {
        $today = new \DateTime('now');
        $dueDate = new \DateTime($this->splatnost);

        return $today >= $dueDate;
    }

    public function getStatusText()
    {
        $text = [
            1   =>  'Čaká na splatenie',
            2   =>  'Splatené',
            3   =>  'Zrušené',
        ];
        return $text[$this->status];
    }

    public function getInvoiceTypeCode()
    {
        $code = [
            0 => 'FAK',
            1 => 'ZAL',
            2 => 'DOB',
        ];

        return $code[$this->typ_faktury];
    }

    public function getInvoiceNumber()
    {
        $number = $this->znak.$this->rok;
        if ($this->dodavatel->platca_dph == 1) {
            $number .= str_pad($this->mesiac,2,'0',STR_PAD_LEFT);
        }
        return $number . $this->cislo;
    }

}