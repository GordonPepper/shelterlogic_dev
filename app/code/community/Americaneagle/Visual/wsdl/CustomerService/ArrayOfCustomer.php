<?php

namespace Visual\CustomerService;

class ArrayOfCustomer
{

    /**
     * @var Customer[] $Customer
     */
    protected $Customer = null;

    
    public function __construct()
    {
    
    }

    /**
     * @return Customer[]
     */
    public function getCustomer()
    {
      return $this->Customer;
    }

    /**
     * @param Customer[] $Customer
     * @return \Visual\CustomerService\ArrayOfCustomer
     */
    public function setCustomer(array $Customer = null)
    {
      $this->Customer = $Customer;
      return $this;
    }

}
