<?php

declare(strict_types=1);

class Invoice
{
    private static $id_count = 1;
    private $id;
    private static $invoice_number_helper = 1;
    private $invoice_number = "FRA/";
    private static $seller_data = ["name" => "Itemownia sp. z o.o.", "adress" => "Fabryczna 5"];  //istotna zmiana

    private $company;
    private $purchase;

    private static $invoice_list = [];

    public function getInvoiceData(): array
    {
        $invoice_data = [$this->seller_data["name"], $this->seller_data["adress"], "id" => $this->id, "invoice_number" => $this->invoice_number];
        return  $invoice_data;
    }

    public function get_company(): Company
    {
        return $this->company;
    }

    public static function get_array_list(): array
    {
        return self::$invoice_list;
    }

    public function set_company(Company $company): void
    {

        if (!$this->company) {

            $this->company = $company;

            $company->add_invoice($this);
        }
    }

    public function set_purchase(Purchase $purchase): void
    {
        if (!$this->purchase) {
            $this->purchase = $purchase;
        }
    }

    public function __construct()
    {
        $this->id = self::$id_count;
        self::$id_count++;

        $this->invoice_number . getDate()["mon"] . "/" . self::$invoice_number_helper;
        self::$invoice_number_helper++;

        $this->add_to_array_list($this);
    }

    // private static function getIdCount():int
    // {
    //     return self::$id_count;
    // }

    private function add_to_array_list(self $invoice): void
    {
        self::$invoice_list[] = $invoice;
    }
}
