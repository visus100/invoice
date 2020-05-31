<?php

declare(strict_types=1);
require_once "../../Utils/debug.php";
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


            //dane informacyjne
            $query = "SELECT purchase.id, purchase.date_of_order, purchase.id_worker, purchase.id_customer, worker.name, worker.surname, worker.phone, worker.work_position, invoice.invoice_number, invoice.id_company, invoice.id_purchase, invoice.id_worker FROM purchase 
            INNER JOIN customer ON Purchase.id_customer = customer.id 
            INNER JOIN worker ON Purchase.id_worker = worker.id
            LEFT JOIN invoice ON Purchase.id = invoice.id_purchase";
            $result = self::$conn->query($query);
            $purchase_data_list = $result->fetchAll(PDO::FETCH_ASSOC); // save all records



            //lista towarów w zamówieniu
            $query = "SELECT purchase_item.id_purchase  , purchase_item.id_item, item.name , item.price_per_unit FROM purchase
            INNER JOIN purchase_item ON purchase.id = purchase_item.id_purchase
            INNER JOIN item ON purchase_item.id_item = item.id";
            $result = self::$conn->query($query);
            $pruchase_item_list = $result->fetchAll(PDO::FETCH_ASSOC); // save all records

            //lista towarów na fakturze
            $query = "SELECT invoice.id_purchase, invoice.invoice_number, invoice_item.id_invoice, invoice_item.id_item, item.name, item.price_per_unit FROM invoice 
            INNER JOIN purchase ON invoice.id_purchase = purchase.id 
            INNER JOIN invoice_item ON invoice.id = invoice_item.id_invoice
            INNER JOIN item ON invoice_item.id_item = item.id";
            $result = self::$conn->query($query);
            $invoice_item_list = $result->fetchAll(PDO::FETCH_ASSOC); // save all records

            //  dump($invoice_item_list);

            $db_list = $purchase_data_list;

            for ($i = 0; $i < count($db_list); $i++) {
                $db_list[$i]["pruchase_item_list"] = [];
                $db_list[$i]["invoice_item_list"] = [];

                for ($n = 0; $n < count($pruchase_item_list); $n++) {
                    if ($pruchase_item_list[$n]["id_purchase"] === $db_list[$i]["id"]) {
                        $db_list[$i]["pruchase_item_list"][] = $pruchase_item_list[$n];
                    }
                }

                for ($n = 0; $n < count($invoice_item_list); $n++) {
                    if ($invoice_item_list[$n]["id_purchase"] === $db_list[$i]["id"]) {
                        $db_list[$i]["invoice_item_list"][] = $invoice_item_list[$n];
                    }
                }
            }


            dump($db_list);

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
