<?php

declare(strict_types=1);

class Item{
    private $id;
    private $name;
    private $price_per_unit;

    public function __construct(int $id, string $name, float $price_per_unit){
        $this->id = $id;
        $this->name = $name;
        $this->price_per_unit = $price_per_unit;
    }

    public function get_item_price():float
    {
       
        return $this->price_per_unit;
    }

}