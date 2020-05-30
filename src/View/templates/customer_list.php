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

<div>Customer list</div>

<div>
  <?php

  foreach ($customer_list as $value) {

    print_r($value->get_personal_data());

    echo "<br>";
  }

  ?>

</div>

<?php
require "incule_bottom_html.php";
?>