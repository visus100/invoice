<?php

declare(strict_types=1);
//require_once "src/Interfaces/DataInterface.php";

abstract class Person extends AbstractModel
{

    protected $id;
    protected $name;
    protected $surname;
    protected $phone; //long have to changed for string


    abstract function get_personal_data();
}
