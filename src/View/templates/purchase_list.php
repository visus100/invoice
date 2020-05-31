<?php

require_once "../../Model/AbstractModel.php";
require_once "../../Model/Purchase.php";

$configuration = require_once("../../../config/config.php");

require "include_top_html.php";


Purchase::create_objects($configuration);

$purchase_list = Purchase::get_array_list();

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
          date of order
        </th>
        <th>
          worker
        </th>
        <th>
          custumer
        </th>
      </tr>
    </thead>
    <tbody style="line-height:30px;">

      <?php
      foreach ($purchase_list as $value) {
        echo "<tr>";
        foreach ($value->get_purchase_data() as $key) {
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