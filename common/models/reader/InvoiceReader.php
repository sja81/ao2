<?php

namespace common\models\reader;

abstract class InvoiceReader
{
    protected $texts = [];

    public function __construct($texts)
    {
        $this->texts = $texts;
    }

    abstract public function getIban();

    abstract public function getBic();

    abstract public function getAccountNumber();

    abstract public function getTaxNumber();

    abstract public function getDodavatel();

    // public function getUlica()
    // {
    //     return preg_grep('/[A-Z]{1}[a-z]{1}/', $this->texts);
    // }

    abstract function getBusinessId();

    abstract function getPayment();

    abstract function getVat();

    abstract function getDates();
    
    abstract function getVariableSymbol();
    
}