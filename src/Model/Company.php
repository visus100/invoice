<?php

declare(strict_types=1);

class Company extends AbstractModel
{
    private $id;
    private $name;
    private $nip;   //long have to be changed for string if use countrycode (like pl9519595534)
    private $address;
    private $invoices = [];

    private static $company_list = [];

    public function add_invoice(Invoice $invoice): void
    {

        if (!in_array($invoice, $this->invoices)) {

            $this->invoices[] = $invoice;

            $invoice->set_company($this);
        }
    }


    public function getInvoices(): array
    {
        return $this->invoices;
    }
    public function getCompanyData(): array
    {
        return $companyData = ["id" => $this->id, "name" => $this->name, "nip" => $this->nip];
    }

    public function get_array_list(): array
    {
        return self::$company_list;
    }

    public function get_invoices(): array
    {
        return $this->invoices;
    }
    public function get_company_data(): array
    {
        return $company_data = ["id" => $this->id, "name" => $this->name, "nip" => $this->nip, "address" => $this->address];
    }
    private static function get_companies_from_db(array $config): array
    {

        self::startSQLConnection($config);

        try {
            $query = "SELECT * FROM company";
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
        $company_list = self::get_companies_from_db($config);

        for ($i = 0; $i < count($company_list); $i++) {
            new self($company_list[$i]["id"] * 1, $company_list[$i]["name"], $company_list[$i]["NIP"], $company_list[$i]["address"]);
        }
    }

    public function __construct(int $id, string $name, string $nip, string $address)
    {

        $this->id = $id;
        $this->name = $name;
        $this->nip = $nip;
        $this->address = $address;
        $this->add_to_array_list($this);
    }


    private function add_to_array_list(self $company): void
    {
        self::$company_list[] = $company;
    }
}
