<?php

declare(strict_types=1);

class Invoice{
    private $id;
    private $company_id;
    private $seller_data;

    public function __construct(int $id, int $company_id, array $seller_data){
        $this->id = $id;
        $this->company_id = $company_id;
        $this->seller_data = $seller_data;
    }

    private function count_total_price():float
    {
        $total_price;
        return $total_price;

    }

}