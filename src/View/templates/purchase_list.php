<?php

require_once "../../Model/AbstractModel.php";
require_once "../../Model/Purchase.php";
require_once "../../Model/Person.php";
require_once "../../Model/Customer.php";
require_once "../../Model/Worker.php";
require_once "../../Model/Invoice.php";
require_once "../../Model/Company.php";

$configuration = require_once("../../../config/config.php");

require "include_top_html.php";

Purchase::create_objects($configuration);
$purchase_list = Purchase::get_array_list();
//dump($purchase_list);

?>

<div style="padding-bottom:10px;">Purchase list</div>

<div>
  <table style="border: 1px solid black;">
    <thead>
      <tr style="background-color: silver;">
        <th>
          id
        </th>
        <th>
          date of order
        </th>
        <th>
          w_id
        </th>
        <th>
          w_name
        </th>
        <th>
          w_surname
        </th>
        <th>
          c_id
        </th>
        <th>
          c_name
        </th>
        <th>
          c_surname
        </th>
        <th>
          i_id
        </th>
        <th>
          i_number
        </th>
        <th>
          i_id
        </th>
        <th>
          c_name
        </th>
        <th>
          i_nip
        </th>

      </tr>
    </thead>
    <tbody style="line-height:30px;">

      <?php




      foreach ($purchase_list as $value) {
        echo "<tr>";
        $purchase_data = $value->get_purchase_data();

        foreach ($purchase_data as $key) {
          echo "<td>";
          echo  $key;
          echo "</td>";
        }

        $worker_data = $value->get_worker();
        $worker_data = $worker_data->get_worker_data();

        echo "<td>";
        echo  $worker_data["id"];
        echo "</td>";
        echo "<td>";
        echo  $worker_data["name"];
        echo "</td>";
        echo "<td>";
        echo  $worker_data["surname"];
        echo "</td>";

        $customer_data = $value->get_customer();
        $customer_data = $customer_data->get_personal_data();

        echo "<td>";
        echo  $customer_data["id"];
        echo "</td>";
        echo "<td>";
        echo  $customer_data["name"];
        echo "</td>";
        echo "<td>";
        echo  $customer_data["surname"];
        echo "</td>";

        if ($value->get_invoice()) {
          $invoice_data = $value->get_invoice();

          $company_data = $invoice_data->get_company();
          $company_data =  $company_data->getCompanyData();

          $invoice_data = $invoice_data->get_invoice_data();

          echo "<td>";
          echo  $invoice_data["id"];
          echo "</td>";
          echo "<td>";
          echo  $invoice_data["invoice_number"];
          echo "</td>";
          echo "<td>";
          echo  $company_data["id"];
          echo "</td>";
          echo "<td>";
          echo  $company_data["name"];
          echo "</td>";
          echo "<td>";
          echo  $company_data["nip"];
          echo "</td>";
        } else {
          echo "<td>";
          echo "</td>";
          echo "<td>";
          echo "</td>";
        }

        echo "</tr>";
      }
      ?>

    </tbody>
  </table>
</div>

<?php
require "incule_bottom_html.php";
?>