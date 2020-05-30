<?php

declare(strict_types=1);

class Item
{
    private $id;
    private $name;
    private $price_per_unit;

    private static $item_list = [];

    private static $itemCounter = 1;
    private $purchase;


    public static function get_array_list(): array
    {
        return self::$item_list;
    }

    public function get_item_price(): float
    {
        return $this->price_per_unit;
    }
    public function get_item_data(): array
    {
        return ["id" => $this->id, "name" => $this->name, "price" => $this->price_per_unit];
    }

    public function set_purchase(Purchase $purchase): void
    {
        if (!$this->purchase) {
            $this->purchase = $purchase;
        }
    }
    public function __construct(string $name, float $price_per_unit)
    {
        $this->id = self::$itemCounter;
        $this->name = $name;
        $this->price_per_unit = $price_per_unit;
        self::$itemCounter++;

        $this->add_to_array_list($this);
    }



    private function add_to_array_list(self $item): void
    {
        self::$item_list[] = $item;
    }
}
