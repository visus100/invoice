<?php

declare(strict_types=1);
require_once "src/View/View.php";

//require_once "src/Model/AbstractModel.php";

require_once "src/Model/Worker.php";
require_once "src/Model/Customer.php";
require_once "src/Model/Company.php";
require_once "src/Model/Invoice.php";
require_once "src/Model/Item.php";
require_once "src/Model/Purchase.php";
require_once "src/Utils/debug.php";


$worker = new Worker(1, "test", "test", "123123123", 2000.20, ["może" => true], true, "employee");

$customer = new Customer(1, "Jan", "Nosacz", "543543543", "Ciapkowo");

$company = new Company(1, "Frakpol S.A.", "9519519511");
$company->testConnection($configuration);





$item = new Item(1, "bulbulator", 220);

$purchase = new Purchase(1);
$purchase->setCustomer($customer);
$purchase->setWorker($worker);
$purchase->createInvoice();
$invoice = $purchase->getInvoice();
$invoice->setCompany($company);


dump($invoice);  //funkcja sprawdzająca
dump($invoice->getCompany()->getCompanyData());

echo "<br><br>worker data who created purchase get by association purchase with worker: <br>";
dump($purchase->getWorker()->getWorkerData());
echo "<br><br>single atribute from array: <br>";
dump("name: " . $purchase->getWorker()->getWorkerData()['name']);

var_dump($worker);

echo "<br>";
var_dump($company);

// echo "<br>";
// var_dump($invoice);

echo "<br>";
var_dump($item);

echo "<br>";
var_dump($purchase);

echo "<br>";


var_dump($customer);


$View = new View();
$View->render();

dump(Invoice::get_array_list());
