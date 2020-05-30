<?php

declare(strict_types=1);

class Invoice
{
    private static $idCount = 1;
    private $id;
    private static $invoiceNumberHelper = 1;
    private $invoiceNumber = "FRA/";
    private static $seller_data = ["name" => "Itemownia sp. z o.o.", "adress" => "Fabryczna 5"];  //istotna zmiana

    private $company;
    private $purchase;

    private static $invoice_list = [];

    public function getInvoiceData(): array
    {
        $invoiceData = [$this->seller_data["name"], $this->seller_data["adress"], "id" => $this->id, "invoice_number" => $this->invoiceNumber];
        return  $invoiceData;
    }

    public function getCompany(): Company
    {
        return $this->company;
    }

    public static function get_array_list(): array
    {
        return self::$invoice_list;
    }

    public function setCompany(Company $company): void
    {

        if (!$this->company) {

            $this->company = $company;

            $company->addInvoice($this);

            dump($this->company); //funkcja sprawdzająca
        }
    }

    public function setPurchase(Purchase $purchase): void
    {
        if (!$this->purchase) {
            $this->purchase = $purchase;
        }
    }



    public function __construct()
    {
        $this->id = self::$idCount;
        self::$idCount++;

        $this->invoiceNumber . getDate()["mon"] . "/" . self::$invoiceNumberHelper;
        self::$invoiceNumberHelper++;

        $this->add_to_array_list($this);
    }

    // private static function getIdCount():int
    // {
    //     return self::$idCount;
    // }

    private function add_to_array_list(self $invoice): void
    {
        self::$invoice_list[] = $invoice;
    }
}
