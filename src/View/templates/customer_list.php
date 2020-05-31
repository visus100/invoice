<?php

require_once "../../Model/AbstractModel.php";
require_once "../../Model/Person.php";
require_once "../../Model/Customer.php";

$configuration = require_once("../../../config/config.php");

require "include_top_html.php";


Customer::create_objects($configuration);

$customer_list = Customer::get_array_list();
//print_r(Customer::get_array_list());

?>

<div style="padding-bottom:10px;">Customer list</div>

<div>
  <table style="border: 1px solid black;">
    <thead>
      <tr style="background-color: silver;">
        <th>
          id
        </th>
        <th>
          name
        </th>
        <th>
          surname
        </th>
        <th>
          phone
        </th>
        <th>
          address
        </th>
      </tr>
    </thead>
    <tbody style="line-height:30px;">

      <?php
      foreach ($customer_list as $value) {
        echo "<tr>";
        foreach ($value->get_personal_data() as $key) {
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