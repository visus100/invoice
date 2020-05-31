<?php

require_once "../../Model/AbstractModel.php";
require_once "../../Model/Item.php";

$configuration = require_once("../../../config/config.php");

require "include_top_html.php";


Item::create_objects($configuration);

$item_list = Item::get_array_list();

?>

<div style="padding-bottom:10px;">Item list</div>

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
          price per unit
        </th>
      </tr>
    </thead>
    <tbody style="line-height:30px;">

      <?php
      foreach ($item_list as $value) {
        echo "<tr>";
        foreach ($value->get_item_data() as $key) {
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