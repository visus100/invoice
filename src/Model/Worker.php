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

    public function add_purchase(Purchase $purchase):void
    {   
        if(!in_array($purchase, $this->purchases)){
            $this->purchases[]=$purchase;
            $purchase->set_worker($this);
        }
    }

    public function get_worker_data():array
    {
        $worker_data["id"] = $this->id;
        $worker_data["name"] = $this->name;
        $worker_data["surname"] = $this->surname;
        $worker_data["phone"] = $this->phone;
        $worker_data["salary"] = $this->salary;
        $worker_data["permissions"] = $this->permissions;
        $worker_data["active"] = $this->active;
        $worker_data["work_position"] = $this->work_position;
        return $worker_data;
    }

    //use like up or down
    public function get_personal_data(int $id): array
    {
        $data = ["name" => $this->name, "surname" => $this->surname, "phone" => $this->phone, "salary" => $this->salary, "permissions" => $this->permissions, "active" => $this->active, "work_position" => $this->work_position];

        return $data;
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
    }


}
