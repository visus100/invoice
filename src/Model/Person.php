<?php

require_once "src/Interfaces/DataInterface.php";

abstract class Person implements DataInterface{

    private $id;
    private $name;
    private $surmane;
    private $phone;


    public function get_personal_data(int $id);

}
