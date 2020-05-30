<?php

declare(strict_types=1);

class Item
{
    private $id;
    private $name;
    private $price_per_unit;

    private static $item_list = [];


    public static function get_array_list(): array
    {
        return self::$item_list;
    }

    public function __construct(int $id, string $name, float $price_per_unit)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price_per_unit = $price_per_unit;

        $this->add_to_array_list($this);
    }

    public function get_item_price(): float
    {

        return $this->price_per_unit;
    }

    private function add_to_array_list(self $item): void
    {
        self::$item_list[] = $item;
    }
}
