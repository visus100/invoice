<?php

declare(strict_types=1);
require_once "src/Model/AbstractModel.php";

class Company extends AbstractModel
{
    private $id;
    private $name;
    private $nip;   //long have to be changed for string if use countrycode (like pl9519595534)


    public function testConnection(array $config): void
    {
        $this->startSQLConnection($config);

        try {
            $query = "SELECT * FROM company";
            $result = $this->conn->query($query);
            $company_list = $result->fetchAll(PDO::FETCH_ASSOC); // save all records
            //$company_list = $result->fetch(PDO::FETCH_ASSOC); // save single record ascending


            echo "<br>Dane z bazy danych tabela Company mysql:<br>";
            print_r($company_list);
            echo "<br><br>";
        } catch (Throwable $e) {
            echo ('Nie udało się pobrać notatki 400 ' . $e . "<br><br>");
        }
    }

    public function __construct(int $id, string $name, string $nip)
    {

        $this->id = $id;
        $this->name = $name;
        $this->nip = $nip;
    }
}
