<?php

namespace Visual\CustomerService;

class CreateCustomer2Response
{

    /**
     * @var CustomerData $CreateCustomer2Result
     */
    protected $CreateCustomer2Result = null;

    /**
     * @param CustomerData $CreateCustomer2Result
     */
    public function __construct($CreateCustomer2Result)
    {
      $this->CreateCustomer2Result = $CreateCustomer2Result;
    }

    /**
     * @return CustomerData
     */
    public function getCreateCustomer2Result()
    {
      return $this->CreateCustomer2Result;
    }

    /**
     * @param CustomerData $CreateCustomer2Result
     * @return \Visual\CustomerService\CreateCustomer2Response
     */
    public function setCreateCustomer2Result($CreateCustomer2Result)
    {
      $this->CreateCustomer2Result = $CreateCustomer2Result;
      return $this;
    }

}
