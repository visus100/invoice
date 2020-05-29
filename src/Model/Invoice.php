<?php

declare(strict_types=1);

class Invoice{
    private $id;
    private $seller_data;

    private $company;

    public function addCompany(Company $company):void
    {   

        if(!$this->company){ 
            
            $this->company = $company;

            $company->addInvoice($this);

            dump($this->company); //funkcja sprawdzająca
        }

    }

    public function __construct(int $id, array $seller_data){
        $this->id = $id;
        $this->seller_data = $seller_data;
    }

    private function count_total_price():float
    {
        $total_price;
        return $total_price;

    }

}