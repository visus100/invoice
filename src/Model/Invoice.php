<?php

declare(strict_types=1);

class Invoice{
    private static $idCount = 1;
    private $id;
    private static $invoiceNumberHelper = 1;
    private $invoiceNumber = "FRA/";
    private static $seller_data = ["name"=>"Itemownia sp. z o.o.", "adress"=>"Fabryczna 5"];  //istotna zmiana
    
    private $company;
    private $purchase;

    public function getInvoiceData():array
    {
        $invoiceData = [...$this->seller_data, "id"=>$this->id, "invoice_number"=>$this->invoiceNumber];
        return  $invoiceData;
    }

    public function getCompany():Company
    {
        return $this->company;
    }

    public function setCompany(Company $company):void
    {   

        if(!$this->company){ 
            
            $this->company = $company;

            $company->addInvoice($this);

            dump($this->company); //funkcja sprawdzająca
        }

    }

    public function setPurchase(Purchase $purchase):void
    {
        if(!$this->purchase){
            $this->purchase = $purchase;
        }
    }


    public function __construct(){
        $this->id = self::$idCount;
        self::$idCount++;

        $this->invoiceNumber . getDate()["mon"] ."/". self::$invoiceNumberHelper;
        self::$invoiceNumberHelper++;
    }

    // private static function getIdCount():int
    // {
    //     return self::$idCount;
    // }

    private function count_total_price():float
    {
        $total_price;
        return $total_price;
    }

}