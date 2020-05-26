<?php

declare(strict_types=1);

class Company{
    private $id;
    private $name;
    private $nip;   //long have to be changed for string if use countrycode (like pl9519595534)

    public function __construct(int $id, string $name, string $nip){
        $this->id = $id;
        $this->name = $name;
        $this->nip = $nip;
    }
}