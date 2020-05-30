<?php

declare(strict_types=1);

class View
{

  public function render(): void // method to show functions in class
  {

    require "templates/include_top_html.php";
?>
    <div>
      <ul style="line-height:30px;">
        <li><a href="src/View/templates/new_purchase.php">New purchase</a></li>
        <li><a href="src/View/templates/purchase_list.php">Purchase list</a></li>
        <li><a href="src/View/templates/item_list.php">Item list</a></li>
        <li><a href="src/View/templates/invoice_list.php">Invoice list</a></li>
        <li><a href="src/View/templates/company_list.php">Company list</a></li>
        <li><a href="src/View/templates/worker_list.php">Worker list</a></li>
        <li><a href="src/View/templates/customer_list.php">Customer list</a></li>
      </ul>

    </div>
<?php
    require "templates/incule_bottom_html.php";
  }
}
?>