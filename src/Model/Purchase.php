<?php
declare(strict_types=1);

class Purchase{
    private $id;
    private $date_of_order;
    private $customer;
    private $worker;
    private $invoices = [];

    public function setCustomer(Customer $customer):void
    {
        if(!$this->customer){
            $this->customer = $customer;
            $customer->addPurchase($this);
        }
    }
    public function setWorker(Worker $worker):void
    {
        if(!$this->worker){
            $this->worker = $worker;
            $worker->addPurchase($this);
        }
    }
    public function createInvoice():void
    {
        $invoice = new Invoice();
        if(!in_array($invoice, $this->invoices)){
            $this->invoices[] = $invoice;
            $invoice->setPurchase($this);
        }

    }
    public function getInvoice():Invoice
    {
        return $this->invoices[0];
    }

    public function getWorker():Worker
    {
        return $this->worker;
    }

    public function __construct(int $id){
        $this->id = $id;
        $this->date = getdate();
    }
}