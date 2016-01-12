<?php

namespace Visual\CustomerService;

class CustomerData
{

    /**
     * @var ArrayOfCustomer $Customers
     */
    protected $Customers = null;

    
    public function __construct()
    {
    
    }

    /**
     * @return ArrayOfCustomer
     */
    public function getCustomers()
    {
      return $this->Customers;
    }

    /**
     * @param ArrayOfCustomer $Customers
     * @return \Visual\CustomerService\CustomerData
     */
    public function setCustomers($Customers)
    {
      $this->Customers = $Customers;
      return $this;
    }

}
