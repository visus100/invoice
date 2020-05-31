<?php

declare(strict_types=1);

class Purchase extends AbstractModel
{
    private $id;
    private $date_of_order;
    private $customer;
    private $worker;
    private $invoices = [];
    private $total_price;
    private $items = [];

    private static $purchase_list = [];

    public static function get_array_list(): array
    {
        return self::$purchase_list;
    }

    public function get_purchase_data(): array
    {
        $data = ["id" => $this->id, "date_of_order" => $this->date_of_order];

        return $data;
    }

    private static function get_purchase_from_db(array $config): array
    {

        self::startSQLConnection($config);

        try {
            $query = "SELECT * FROM Purchase";
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
        $purchase_list = self::get_purchase_from_db($config);

        for ($i = 0; $i < count($purchase_list); $i++) {
            new self($purchase_list[$i]["id"] * 1, $purchase_list[$i]["date_of_order"], $purchase_list[$i]["id_worker"], $purchase_list[$i]["id_customer"]);
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

    public function set_customer(Customer $customer): void
    {
        if (!$this->customer) {
            $this->customer = $customer;
            $customer->add_purchase($this);
        }
    }
    public function set_worker(Worker $worker): void
    {
        if (!$this->worker) {
            $this->worker = $worker;
            $worker->add_purchase($this);
        }
    }
    public function create_invoice(): void
    {
        $invoice = new Invoice();
        if (!in_array($invoice, $this->invoices)) {
            $this->invoices[] = $invoice;
            $invoice->set_purchase($this);
        }
    }
    public function get_invoice(): Invoice
    {
        return $this->invoices[0];
    }
    public function get_items(): array
    {
        return $this->items;
    }
    public function get_total_price(): float
    {
        return $this->total_price;
    }

    public function get_worker(): Worker
    {
        return $this->worker;
    }

    public function purchase_item(int $quantity): void
    {
        /* for ($i = 0; $i < $quantity; $i++) {
            $item = new Item("brokuł", 3.90);
            $this->items[] = $item;
            $this->totalPrice .= $item->get_item_price();
            $item->set_purchase($this);
        } */
    }


    public function __construct(int $id)
    {
        $this->id = $id;
        $this->date = getdate();

        $this->add_to_array_list($this);
    }

    private function add_to_array_list(self $purchase): void
    {
        self::$purchase_list[] = $purchase;
    }
}
