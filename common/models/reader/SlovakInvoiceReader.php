<?php

namespace common\models\reader;

class SlovakInvoiceReader extends InvoiceReader
{
    public function getIban()
    {
        return preg_grep('/[A-Z]{2}[0-9]{22}/', $this->texts);
    }

    public function getBic()
    {
        return preg_grep('/[A-Z]{8,11}/', $this->texts);
    }

    public function getAccountNumber()
    {
        return preg_grep('#[0-9]{0,10}[/][0-9]{4}#', $this->texts);
    }

    public function getTaxNumber()
    {
        return preg_grep('/[A-Z]{2}[0-9]{8}\b/', $this->texts);
    }

    public function getBusinessId()
    {
        return preg_grep('/\b[0-9]{8}\b/', $this->texts);
    }

    public function getPayment()
    {
        return preg_grep('/.[0-9]{0,}.[0-9]{0,}./', $this->texts);
    }

    public function getVat()
    {
        return preg_grep('/[0-9]{2}[%]/',$this->texts);
    }

    public function getDates()
    {
        return preg_grep('/[0-9]{2}[.][0-9]{2}[.][0-9]{4}/',$this->texts);
    }

    public function getVariableSymbol()
    {
        return preg_grep('/[0-9]{0,10}/', $this->texts);
    }

       public function getDodavatel()
    {
        return preg_grep('/[A-Z]{1}[a-z]{1,}\h[A-Z]{1}[a-z]{0,}/', $this->texts);
    }
}
