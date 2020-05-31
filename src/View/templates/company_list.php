<?php

require_once "../../Model/AbstractModel.php";
require_once "../../Model/Company.php";

$configuration = require_once("../../../config/config.php");

require "include_top_html.php";

Company::create_objects($configuration);
$company_list = Company::get_array_list();
// print_r(Company::get_array_list());
?>

<div style="padding-bottom:10px;">Company list</div>

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
          NIP
        </th>
        <th>
          address
        </th>
      </tr>
    </thead>
    <tbody style="line-height:30px;">

      <?php
      foreach ($company_list as $value) {
        echo "<tr>";
        foreach ($value->get_company_data() as $key) {
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