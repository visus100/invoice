<?php

declare(strict_types=1);

require_once "Person.php";

class Worker extends Person
{

    private $salary;
    private $permissions;
    private $active;
    private $work_position;


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

    public function get_personal_data(int $id): array
    {
        $data = ["name" => $this->name, "surname" => $this->surname, "phone" => $this->phone, "salary" => $this->salary, "permissions" => $this->permissions, "active" => $this->active, "work_position" => $this->work_position];

        return $data;
    }
}
