<?php

require_once "../../Model/AbstractModel.php";
require_once "../../Model/Invoice.php";

$configuration = require_once("../../../config/config.php");

require "include_top_html.php";


Invoice::create_objects($configuration);

$invoice_list = Invoice::get_array_list();

?>

<div style="padding-bottom:10px;">Invoice list</div>

<div>
  <table style="border: 1px solid black;">
    <thead>
      <tr style="background-color: silver;">
        <th>
          id
        </th>
        <th>
          invoice number
        </th>
        <th>
          company
        </th>
        <th>
          purchase
        </th>
        <th>
          worker
        </th>
      </tr>
    </thead>
    <tbody style="line-height:30px;">

      <?php
      foreach ($invoice_list as $value) {
        echo "<tr>";
        foreach ($value->get_invoice_data() as $key) {
          echo "<td>";
          echo  $key;
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