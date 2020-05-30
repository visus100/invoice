<?php

declare(strict_types=1);

class Item{
    private $id;
    private $name;
    private $price_per_unit;
    private static $itemCounter = 1;
    private $purchase;

    public function get_item_price():float
    {
        return $this->price_per_unit;
    }
    public function get_item_data():array
    {
        return ["id"=>$id, "name"=>$name, "price"=>$price_per_unit];
    }
    public function set_purchase(Purchase $purchase):void
    {
        if(!$this->purchase){
            $this->purchase = $purchase;
        }
    }
    public function __construct(string $name, float $price_per_unit){
        $this->id = self::$itemCounter;
        $this->name = $name;
        $this->price_per_unit = $price_per_unit;
        self::$itemCounter++;
    }



}