<?php

declare(strict_types=1);
require_once "../../Utils/debug.php";
class Purchase extends AbstractModel
{
    private $id;
    private $date_of_order;
    private $customer;
    private $worker;
    private $invoices;
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
            $query = "SELECT purchase.id, purchase.date_of_order, purchase.id_worker, purchase.id_customer, customer.name as customer_name, customer.surname as customer_surname, customer.phone as customer_phone, customer.address as customer_address, worker.name as worker_name, worker.surname as worker_surname, worker.phone as worker_phone, worker.salary, worker.permission_id, worker.work_position, invoice.id as invoice_id, invoice.invoice_number, invoice.id_company, invoice.id_purchase, invoice.id_worker, company.id as company_id, company.name as company_name, company.NIP, company.address as company_address FROM purchase 
            INNER JOIN customer ON Purchase.id_customer = customer.id 
            INNER JOIN worker ON Purchase.id_worker = worker.id
            LEFT JOIN invoice ON Purchase.id = invoice.id_purchase
            LEFT JOIN company ON Invoice.id_company = Company.id";
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
            $object = new self($purchase_list[$i]["id"] * 1, $purchase_list[$i]["date_of_order"], $purchase_list[$i]["id_worker"], $purchase_list[$i]["id_customer"]);

            $customer = new Customer($purchase_list[$i]["id_customer"] * 1, $purchase_list[$i]["customer_name"], $purchase_list[$i]["customer_surname"], $purchase_list[$i]["customer_phone"], $purchase_list[$i]["customer_address"]);

            $worker = new Worker($purchase_list[$i]["id_worker"] * 1, $purchase_list[$i]["worker_name"], $purchase_list[$i]["worker_surname"], $purchase_list[$i]["worker_phone"], $purchase_list[$i]["salary"] * 1, $purchase_list[$i]["permission_id"] * 1, $purchase_list[$i]["work_position"]);



            $object->set_customer($customer);
            $object->set_worker($worker);
            if ($purchase_list[$i]["invoice_id"]) {
                $object->create_invoice($purchase_list[$i]["invoice_id"] * 1, $purchase_list[$i]["invoice_number"]);
                $invoice = $object->get_invoice();
                if ($purchase_list[$i]["company_id"]) {
                    $company = new Company($purchase_list[$i]["company_id"] * 1, $purchase_list[$i]["company_name"], $purchase_list[$i]["NIP"], $purchase_list[$i]["company_address"]);
                    $invoice->set_company($company);
                }
            }
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
    public function create_invoice(int $id, string $invoice_number): void
    {
        $invoice = new Invoice($id, $invoice_number);
        if (!$this->invoices) {
            $this->invoices = $invoice;
            $invoice->set_purchase($this);
        }
    }
    public function get_invoice(): ?Invoice
    {
        return $this->invoices;
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

    public function get_customer(): Customer
    {
        return $this->customer;
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
