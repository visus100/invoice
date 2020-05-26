<?php

declare(strict_types=1);

class Invoice{
    private int $id;
    private int $company_id;
    private array $seller_data;

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