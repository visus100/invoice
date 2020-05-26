<?php
declare(strict_types=1);

class Purchase{
    private $id;
    private $date_of_order;

    public function __construct(int $id){
        $this->id = $id;
        $this->date = getdate();
    }
}