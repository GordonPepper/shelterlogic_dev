<?php

namespace Visual\CustomerService;

class ArrayOfCustomerAddress
{

    /**
     * @var CustomerAddress[] $CustomerAddress
     */
    protected $CustomerAddress = null;

    
    public function __construct()
    {
    
    }

    /**
     * @return CustomerAddress[]
     */
    public function getCustomerAddress()
    {
      return $this->CustomerAddress;
    }

    /**
     * @param CustomerAddress[] $CustomerAddress
     * @return \Visual\CustomerService\ArrayOfCustomerAddress
     */
    public function setCustomerAddress(array $CustomerAddress = null)
    {
      $this->CustomerAddress = $CustomerAddress;
      return $this;
    }

}
