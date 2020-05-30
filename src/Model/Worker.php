<?php

declare(strict_types=1);

require_once "Person.php";

class Worker extends Person
{

    private $salary;
    private $permissions;
    private $active;
    private $work_position;
    private $purchases = [];

    private static $worker_list = [];

    public function getWorkerData(): array
    {
        $workerData["id"] = $this->id;
        $workerData["name"] = $this->name;
        $workerData["surname"] = $this->surname;
        $workerData["phone"] = $this->phone;
        $workerData["salary"] = $this->salary;
        $workerData["permissions"] = $this->permissions;
        $workerData["active"] = $this->active;
        $workerData["work_position"] = $this->work_position;
        return $workerData;
    }

    //use like up or down
    public function get_personal_data(int $id): array
    {
        $data = ["name" => $this->name, "surname" => $this->surname, "phone" => $this->phone, "salary" => $this->salary, "permissions" => $this->permissions, "active" => $this->active, "work_position" => $this->work_position];

        return $data;
    }

    public static function get_array_list(): array
    {
        return self::$worker_list;
    }

    public function addPurchase(Purchase $purchase): void
    {
        if (!in_array($purchase, $this->purchases)) {
            $this->purchases[] = $purchase;
            $purchase->setWorker($this);
        }
    }

    public function __construct(int $id, string $name, string $surname, string $phone, float $salary, array $permissions,  $active, $work_position)
    {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->phone = $phone;
        $this->salary = $salary;
        $this->permissions = $permissions;
        $this->active = $active;
        $this->work_position = $work_position;

        $this->add_to_array_list($this);
    }

    private function add_to_array_list(self $worker)
    {
        self::$worker_list[] = $worker;
    }
}
