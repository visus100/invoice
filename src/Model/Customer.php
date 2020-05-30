<?php



declare(strict_types=1);

//require_once "Person.php";

class Customer extends Person
{

    private $address;
    private $purchases = [];

    private static $customer_list = [];

    public function add_purchase(Purchase $purchase): void
    {
        if (!in_array($purchase, $this->purchases)) {
            $this->purchases[] = $purchase;
            $purchase->set_customer($this);
        }
    }
    public static function get_array_list(): array
    {
        return self::$customer_list;
    }


    private static function get_custumers_from_db(array $config): array
    {

        self::startSQLConnection($config);

        try {
            $query = "SELECT * FROM customer";
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
        $company_list = self::get_custumers_from_db($config);

        for ($i = 0; $i < count($company_list); $i++) {
            new self($company_list[$i]["id"] * 1, $company_list[$i]["name"], $company_list[$i]["surname"], $company_list[$i]["phone"], $company_list[$i]["address"]);
        }
    }

    public static function new_object(int $id, string $name, string $surname, string $phone, string $address): void
    {
        //insert to db functions...

        //if success
        $new_obj = new self($id,  $name,  $surname,  $phone,  $address);
        //else
        //errorr
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

    public function get_personal_data(): array
    {
        $data = ["id" => $this->id, "name" => $this->name, "surname" => $this->surname, "phone" => $this->phone, "address" => $this->address];

        return $data;
    }

    private function add_to_array_list(self $customer): void
    {
        self::$customer_list[] = $customer;
    }
}
