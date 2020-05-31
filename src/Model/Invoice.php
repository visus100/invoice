<?php

declare(strict_types=1);

class Invoice extends AbstractModel
{
    private static $id_count = 1;
    private $id;
    private static $invoice_number_helper = 1;
    private $invoice_number = "FRA/";
    private static $seller_data = ["name" => "Itemownia sp. z o.o.", "adress" => "Fabryczna 5"];  //istotna zmiana

    private $company;
    private $purchase;

    private static $invoice_list = [];

    public function getInvoiceData(): array
    {
        $invoice_data = [$this->seller_data["name"], $this->seller_data["adress"], "id" => $this->id, "invoice_number" => $this->invoice_number];
        return  $invoice_data;
    }

    public function get_company(): Company
    {
        return $this->company;
    }

    public static function get_array_list(): array
    {
        return self::$invoice_list;
    }

    public function get_invoice_data(): array
    {
        $data = ["id" => $this->id, "invoice_number" => $this->invoice_number];

        return $data;
    }

    private static function get_invoice_from_db(array $config): array
    {

        self::startSQLConnection($config);

        try {
            $query = "SELECT * FROM Invoice";
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
        $invoice_list = self::get_invoice_from_db($config);

        for ($i = 0; $i < count($invoice_list); $i++) {
            new self($invoice_list[$i]["id"] * 1, $invoice_list[$i]["invoice_number"], $invoice_list[$i]["id_company"], $invoice_list[$i]["id_purchase"], $invoice_list[$i]["id_worker"]);
        }
    }

    public static function new_object(int $id, string $invoice_number): void
    {
        //insert to db functions...

        //if success
        $new_obj = new self($id,  $invoice_number);
        //else
        //errorr
    }

    public function set_company(Company $company): void
    {

        if (!$this->company) {

            $this->company = $company;

            $company->add_invoice($this);
        }
    }

    public function set_purchase(Purchase $purchase): void
    {
        if (!$this->purchase) {
            $this->purchase = $purchase;
        }
    }

    public function __construct(int $id, string $invoice_number)
    {
        $this->id = $id;
        $this->invoice_number = $invoice_number;
        //   $this->id = self::$id_count;
        self::$id_count++;

        //   $this->invoice_number . getDate()["mon"] . "/" . self::$invoice_number_helper;
        //   self::$invoice_number_helper++;

        $this->add_to_array_list($this);
    }

    // private static function getIdCount():int
    // {
    //     return self::$id_count;
    // }

    private function add_to_array_list(self $invoice): void
    {
        self::$invoice_list[] = $invoice;
    }
}
