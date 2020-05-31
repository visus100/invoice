<?php

declare(strict_types=1);

class Item extends AbstractModel
{
    private $id;
    private $name;
    private $price_per_unit;

    private static $item_list = [];

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
        return ["id" => $this->id, "name" => $this->name, "price" => number_format($this->price_per_unit, 2, ',', ' ')];
    }



    private static function get_item_from_db(array $config): array
    {

        self::startSQLConnection($config);

        try {
            $query = "SELECT * FROM item";
            $result = self::$conn->query($query);
            $db_list = $result->fetchAll(PDO::FETCH_ASSOC); // save all records

            return $db_list;
        } catch (Throwable $e) {
            echo ('Nie udało się pobrać notatki 400 ' . $e . "<br><br>");
            return [];
        }
    }

    public static function create_objects(array $config): void
    {
        $item_list = self::get_item_from_db($config);

        for ($i = 0; $i < count($item_list); $i++) {
            new self($item_list[$i]["id"] * 1, $item_list[$i]["name"], floatval($item_list[$i]["price_per_unit"]));
        }
    }

    public static function new_object(int $id, string $name, float $price_per_unit): void
    {
        //insert to db functions...

        //if success
        $new_obj = new self($id,  $name,  $price_per_unit);
        //else
        //errorr
    }

    public function set_purchase(Purchase $purchase): void
    {
        if (!$this->purchase) {
            $this->purchase = $purchase;
        }
    }
    public function __construct(int $id, string $name, float $price_per_unit)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price_per_unit = $price_per_unit;

        $this->add_to_array_list($this);
    }



    private function add_to_array_list(self $item): void
    {
        self::$item_list[] = $item;
    }
}
