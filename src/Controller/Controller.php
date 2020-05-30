<?php

declare(strict_types=1);
require_once "src/View/View.php";
/* require_once "src/Model/Worker.php";
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
$item = new Item("bulbulator", 220);

$purchase = new Purchase(1);
$purchase->set_customer($customer);
$purchase->set_worker($worker);
$purchase->create_invoice();
$invoice = $purchase->get_invoice();
$invoice->set_company($company); */
/*
//worker data who created purchase get by association purchase with worker:
dump($purchase->get_worker()->get_worker_data());
//single atribute from array:
dump("name: " . $purchase->get_worker()->get_worker_data()['name']);
*/

$View = new View();
$View->render();
