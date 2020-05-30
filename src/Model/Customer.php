<?php

declare(strict_types=1);

require_once "Person.php";

class Customer extends Person
{

    private $address;
    private $purchases = [];


    private static $customer_list = [];

    public function addPurchase(Purchase $purchase): void
    {
        if (!in_array($purchase, $this->purchases)) {
            $this->purchases[] = $purchase;
            $purchase->setCustomer($this);
        }
    }
    public static function get_array_list(): array
    {
        return self::$customer_list;
    }

    public function __construct(int $id, string $name, string $surname, string $phone, string $address)
    {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->phone = $phone;
        $this->address = $address;

        $this->add_to_array_list($this);
    }

    public function get_personal_data(int $id): array
    {
        $data = ["name" => $this->name, "surname" => $this->surname, "phone" => $this->phone, "address" => $this->address];

        return $data;
    }

    private function add_to_array_list(self $customer): void
    {
        self::$customer_list[] = $customer;
    }
}
