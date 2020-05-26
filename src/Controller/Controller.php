<?php
declare(strict_types=1);
require_once "src/View/View.php";

require_once "src/Model/Worker.php";
require_once "src/Model/Customer.php";
require_once "src/Model/Company.php";
require_once "src/Model/Invoice.php";
require_once "src/Model/Item.php";
require_once "src/Model/Purchase.php";

$worker = new Worker(1, "test", "test", "123123123", 2000.20, ["może" =>true], true, "employee");

$customer = new Customer(1, "Jan", "Nosacz", "543543543", "Ciapkowo");

$company = new Company(1, "Frakpol S.A.", "9519519511");

$invoice = new Invoice(1, 1, ["Itemowania", "Gdynia"]);

$item = new Item(1, "bulbulator", 220);

$purchase = new Purchase(1);

var_dump($worker);

echo "<br>";
var_dump($company);

echo "<br>";
var_dump($invoice);

echo "<br>";
var_dump($item);

echo "<br>";
var_dump($purchase);

echo "<br>";

var_dump($customer);
$View = new View();
$View->render();
