<?php

namespace common\models\mrp\xmlgenerator;

use Yii;
use common\models\mrp\MrpGenerator;
use common\models\mrp\xmlgenerator\InvoiceInfo;
use common\models\mrp\xmlgenerator\CompanyInfo;
use common\models\mrp\xmlgenerator\Items;
use common\models\mrp\xmlgenerator\Payments;
use common\models\mrp\xmlgenerator\SumValues;
use common\models\mrp\xmlgenerator\Settings;

class XmlGenerator extends MrpGenerator
{
    private static $generatorVersion = "1.0";

    private $payInfo = null;
    private $valInfo = null;
    private $settingsInfo = null;

    /**
     * @param InvoiceInfo $info
     * @param array $recipients array of EphRecipient objects
     * @param CompanyInfo $coInfo
     * @param Items $itemInfo
     */

    /*
        public function __construct(array $mrpInvoices, Settings $settings)
        {

        }
     */
    public function __construct(
        array $mrpInvoices,
        Settings $settingsInfo

    ) {
        // $this->docInfo = $docInfo;
        // $this->coInfo = $coInfo;
        // $this->itemInfo = $itemInfo;
        // $this->payInfo = $payInfo;
        // $this->valInfo = $valInfo;
        $this->settingsInfo = $settingsInfo;
        $this->mrpInvoices = $mrpInvoices;

        $this->date = $date ?? (new \DateTimeImmutable("now"))->format("Ymd");
    }

    public function create(): void
    {
        $this->content = '<MRPKSData version="' . $this->settingsInfo->getVersion() . '" countryCode="' . $this->settingsInfo->getCountryCode() . '" currencyCode="' . $this->settingsInfo->getCurrencyCode() . '">' . "\n";
        $this->content .= "\t<IssuedInvoices>\n";
        foreach ($this->mrpInvoices as $info) {
            $this->content .= "\t\t<Invoice>\n";
            $this->content .= "\t\t\t<DocumentNumber>{$info['invoiceInfo']->getDocumentNumber()}</DocumentNumber>\n";
            $this->content .= "\t\t\t<IssueDate>{$info['invoiceInfo']->getIssueDate()}</IssueDate>\n";
            $this->content .= "\t\t\t<CurrencyCode>{$info['invoiceInfo']->getCurrencyCode()}</CurrencyCode>\n";
            $this->content .= "\t\t\t<ContractNumber>{$info['invoiceInfo']->getContractNumber()}</ContractNumber>\n";
            $this->content .= "\t\t\t<EURExchangeRate>{$info['invoiceInfo']->getEURExchangeRate()}</EURExchangeRate>\n";
            $this->content .= "\t\t\t<VariableSymbol>{$info['invoiceInfo']->getVariableSymbol()}</VariableSymbol>\n";
            $this->content .= "\t\t\t<ConstantSymbol>{$info['invoiceInfo']->getConstantSymbol()}</ConstantSymbol>\n";
            $this->content .= "\t\t\t<PaymentDueDate>{$info['invoiceInfo']->getPaymentDueDate()}</PaymentDueDate>\n";
            $this->content .= "\t\t\t<PaidAmount>{$info['invoiceInfo']->getPaidAmount()}</PaidAmount>\n";
            $this->content .= "\t\t\t<PaidAmountWithTax>{$info['invoiceInfo']->getPaidAmountDph()}</PaidAmountWithTax>\n";
            $this->content .= "\t\t\t<InvoiceType>{$info['invoiceInfo']->getInvoiceType()}</InvoiceType>\n";
            $this->content .= "\t\t\t<Note>{$info['invoiceInfo']->getNote()}</Note>\n";
            $this->content .= "\t\t\t<DeliveryDate>{$info['invoiceInfo']->getDeliveryDate()}</DeliveryDate>\n";
            $this->content .= "\t\t\t<PaymentMeansCode>{$info['invoiceInfo']->getPaymentMeansCode()}</PaymentMeansCode>\n";
            $this->content .= "\t\t\t<TransferredTax>{$info['invoiceInfo']->getTransferredTax()}</TransferredTax>\n";
            $this->content .= "\t\t\t<Zaloha>{$info['invoiceInfo']->getZaloha()}</Zaloha>\n";

            $this->content .= "\t\t\t<Company>\n";
            $this->content .= "\t\t\t<CompanyId>{$info['companyInfo']->getCompanyIco()}</CompanyId>\n";
            $this->content .= "\t\t\t<CompanyName>{$info['companyInfo']->getCompanyName()}</CompanyName>\n";
            $this->content .= "\t\t\t<Name>{$info['companyInfo']->getName()}</Name>\n";
            $this->content .= "\t\t\t<Street>{$info['companyInfo']->getStreet()}</getStreet>\n";
            $this->content .= "\t\t\t<City>{$info['companyInfo']->getCity()}</City>\n";
            $this->content .= "\t\t\t<Country>{$info['companyInfo']->getCountry()}</Country>\n";
            $this->content .= "\t\t\t<ZipCode>{$info['companyInfo']->getZipCode()}</ZipCode>\n";
            $this->content .= "\t\t\t<VatNumber>{$info['companyInfo']->getVatNumber()}</VatNumber>\n";
            $this->content .= "\t\t\t<VatIndentificationNumber>{$info['companyInfo']->getIcDph()}</VatIdentificationNumber>\n";
            $this->content .= "\t\t\t<Note>{$info['companyInfo']->getNote()}</Note>\n";
            $this->content .= "\t\t\t<SupplierTitle>{$info['companyInfo']->getSupplierTitle()}</SupplierTitle>\n";
            $this->content .= "\t\t\t<SupplierName>{$info['companyInfo']->getSupplierName()}</SupplierName>\n";
            $this->content .= "\t\t\t<SupplierStreet>{$info['companyInfo']->getSupplierStreet()}</SupplierStreet>\n";
            $this->content .= "\t\t\t<SupplierStreetCode>{$info['companyInfo']->getSupplierStreetCode()}</SupplierStreetCode>\n";
            $this->content .= "\t\t\t<SupplierCountry>{$info['companyInfo']->getSupplierCountry()}</SupplierCountry>\n";
            $this->content .= "\t\t\t</Company>\n";

            $this->content .= "\t\t\t<Items>\n";
            foreach ($info['items'] as $item) {
                $this->content .= "\t\t\t\t<Item>\n";
                $this->content .= "\t\t\t\t\t<Description>{$item->getDescription()}</Description>\n";
                $this->content .= "\t\t\t\t\t<Quantity>{$item->getQuantity()}</Quantity>\n";
                $this->content .= "\t\t\t\t\t<UnitPrice>{$item->getUnitPrice()}</UnitPrice>\n";
                $this->content .= "\t\t\t\t\t<TaxAmount>{$item->getTaxAmount()}</TaxAmount>\n";
                $this->content .= "\t\t\t\t\t<DiscountPercent>{$item->getDiscountPercent()}</DiscountPercent>\n";
                $this->content .= "\t\t\t\t\t<ContractNumber>{$item->getContractNumber()}</ContractNumber>\n";
                $this->content .= "\t\t\t\t\t<SubscriptionStartPeriod>{$item->getSubscriptionStart()}</SubscriptionStartPeriod>\n";
                $this->content .= "\t\t\t\t\t<UnitCode>{$item->getUnitCode()}</UnitCode>\n";
                $this->content .= "\t\t\t\t\t<TotalVat>{$item->getTotalVat()}</TotalVat>\n";
                $this->content .= "\t\t\t\t\t<PriceWithVat>{$item->getPriceWithVat()}</PriceWithVat>\n";
                $this->content .= "\t\t\t\t</Item>\n";
            }
            $this->content .= "\t\t\t</Items>\n";

            if ($this->valInfo) {

                $this->content .= "\t<SumValues>\n";
                foreach ($this->valInfo as $item) {
                    $this->content .= "\t<SumValue>\n";
                    $this->content .= "\t\t<TaxCode>{$item->getTaxCode()}</TaxCode>\n";
                    $this->content .= "\t\t<TaxType>{$item->getTaxType()}</TaxType>\n";
                    $this->content .= "\t\t<TaxPercent>{$item->getTaxPercent()}</TaxPercent>\n";
                    $this->content .= "\t\t<Amount>{$item->getAmount()}</Amount>\n";
                    $this->content .= "\t\t<Tax>{$item->getTax()}</Tax>\n";
                    $this->content .= "\t\t<TaxCurrRateAmount>{$item->getTaxCurrRateAmount()}</TaxCurrRateAmount>\n";
                    $this->content .= "\t\t<TaxCurrRateTax>{$item->getTaxCurrRateTax()}</TaxCurrRateTax>\n";
                    $this->content .= "\t\t<ReverseChargeAmount>{$item->getReverseChargeAmount()}</ReverseChargeAmount>\n";
                    $this->content .= "\t\t<ReverseChargeTax>{$item->getReverseChargeTax()}</ReverseChargeTax>\n";
                    $this->content .= "\t\t<TaxCurrRateReverseChargeAmount>{$item->getTaxCurrRateReverseChargeAmount()}</TaxCurrRateReverseChargeAmount>\n";
                    $this->content .= "\t\t<TaxCurrRateReverseChargeTax>{$item->getTaxCurrRateReverseChargeTax()}</TaxCurrRateReverseChargeAmount>\n";
                    $this->content .= "\t\t<TaxApplied>{$item->getTaxApplied()}</TaxApplied>\n";
                    $this->content .= "</SumValue>\n";
                }
                $this->content .= "</SumValues>\n";
            }

            if ($this->payInfo) {
                $this->content .= "\t<Payments>\n";
                foreach ($this->payInfo as $item) {
                    $this->content .= "\t<Payment>\n";
                    $this->content .= "\t\t<PaymentType>{$item->getPaymentType()}</PaymentType>\n";
                    $this->content .= "\t\t<PaymentDate>{$item->getPaymentDate()}</PaymentDate>\n";
                    $this->content .= "\t\t<DocumentNumber>{$item->getQuantity()}</Quantity>\n";
                    $this->content .= "\t\t<Amount>{$item->getAmount()}</Amount>\n";
                    $this->content .= "\t\t<AmountCurr>{$item->getAmountCurr()}</AmountCurr>\n";
                    $this->content .= "\t\t<AmountPaidDocumentCurr>{$item->getAmountPaidDocumentCurr()}</AmountPaidDocumentCurr>\n";
                    $this->content .= "\t\t<CurrencyCode>{$item->getCurrencyCode()}</CurrencyCode>\n";
                    $this->content .= "\t\t<CurrRate>{$item->getCurrRate()}</CurrRate>\n";
                    $this->content .= "\t\t<CurrRateAmount>{$item->getCurrRateAmount()}</CurrRateAmount>\n";
                    $this->content .= "</Payment>\n";
                }
                $this->content .= "</Payments>\n";
            }
            $this->content .= "\t\t</Invoice>\n";
        }
        $this->content .= "\t</IssuedInvoices>\n";
        $this->content .= "</MRPKSData>";
    }

    public function downloadFile(string $name): void
    {
        if (headers_sent()) {
            throw new \Exception("Data has already been sent to output, unable to output XML file");
        }

        header("Content-Description: File Transfer");
        header("Content-Transfer-Encoding: binary");
        header("Cache-Control: public, must-revalidate, max-age=0");
        header("Pragma: public");
        header("X-Generator: AOReal Backoffice " . static::$generatorVersion);
        header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Content-Type: application/xml");
        if (empty($_SERVER["HTTP_ACCEPT_ENCODING"])) {
            // don"t use length if server using compression
            header("Content-Length: " . strlen($this->content));
        }

        header('Content-Disposition: attachment; filename="' . $name . '"');

        echo $this->content;

        Yii::$app->end();
    }
}
