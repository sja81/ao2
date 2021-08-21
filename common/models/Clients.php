<?php
namespace common\models;


class Clients
{
    private $inputData = [];

    public function setData(array $data)
    {
        $this->inputData = $data;
    }

    public function insertClient()
    {

    }

    public function updateClient()
    {

    }

    public function listAccountingClients(bool $asArray=false)
    {
        $result = Customer::find()->select([
            'ac_deg_before',
            'ac_deg_after',
            'name_first',
            'name_last',
            'customer_type',
            'address',
            'town',
            'zip',
            'country',
            'obchodne_meno',
            'ico',
            'dic',
            'icdph',
            'adresa',
            'mesto',
            'psc',
            'stat',
            'ssn'
        ])->leftJoin('customer_company','customer_company.customer_id=customer.id');
        if ($asArray) {
            $result->asArray();
        }

        return $result->all();
    }
}