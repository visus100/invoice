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

    public function get_worker_data(): array
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
    public function get_personal_data(): array
    {
        $data = ["id"=>$this->id, "name" => $this->name, "surname" => $this->surname, "phone" => $this->phone, "salary" => $this->salary, "permissions" => $this->permissions, "active" => $this->active, "work_position" => $this->work_position];

        return $data;
    }

    public static function get_array_list(): array
    {
        return self::$worker_list;
    }

    private static function get_workers_from_db(array $config): array
    {
        self::startSQLConnection($config);
        try {
            $query = "SELECT * FROM worker";
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
        $worker_list = self::get_workers_from_db($config);
        for ($i = 0; $i < count($worker_list); $i++) {
            new self($worker_list[$i]["id"] * 1, $worker_list[$i]["name"], $worker_list[$i]["surname"], $worker_list[$i]["phone"], $worker_list[$i]["salary"]*1, $worker_list[$i]["permission_id"]*1, $worker_list[$i]["work_position"]);
        }
    }
    public function add_purchase(Purchase $purchase): void
    {
        if (!in_array($purchase, $this->purchases)) {
            $this->purchases[] = $purchase;
            $purchase->set_worker($this);
        }
    }

    public function __construct(int $id, string $name, string $surname, string $phone, float $salary, int $permissions, $work_position)
    {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->phone = $phone;
        $this->salary = $salary;
        $this->permissions = $permissions;
        $this->work_position = $work_position;

        $this->add_to_array_list($this);
    }

    private function add_to_array_list(self $worker)
    {
        self::$worker_list[] = $worker;
    }
}
