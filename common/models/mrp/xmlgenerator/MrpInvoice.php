<?php

namespace common\models\mrp\xmlgenerator;

use Yii;

class MrpInvoice
{
    private $invoices;


    public function __construct(array $invoices)
    {
        $this->invoices = $invoices;
    }

    /**
     * @return array
     */
    public function process(): array
    {
        $results = [];
        foreach ($this->invoices as $id => $invoice) {
            $results[$id]['invoiceInfo'] = (new InvoiceInfo())->load($invoice);
            $results[$id]['companyInfo'] = (new CompanyInfo())->load($invoice->customer);

            //... polozky faktury
            $items = $invoice->polozky;
            foreach ($items as $pid => $item) {
                $results[$id]['items'][$pid] = (new Items())->load($item);
            }

            //...
        }

        return $results;
    }
}
