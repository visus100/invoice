<?php
declare(strict_types=1);

class Order_item{
    private int $id;
    private date $date_of_order;

    public function __construct(int $id){
        $this->id = $id;
        $this->date = getdate();
    }
}