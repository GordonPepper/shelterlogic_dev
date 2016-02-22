<?php

namespace Visual\CustomerService;

class CreateCustomerResponse
{

    /**
     * @var CustomerData $CreateCustomerResult
     */
    protected $CreateCustomerResult = null;

    /**
     * @param CustomerData $CreateCustomerResult
     */
    public function __construct($CreateCustomerResult)
    {
      $this->CreateCustomerResult = $CreateCustomerResult;
    }

    /**
     * @return CustomerData
     */
    public function getCreateCustomerResult()
    {
      return $this->CreateCustomerResult;
    }

    /**
     * @param CustomerData $CreateCustomerResult
     * @return \Visual\CustomerService\CreateCustomerResponse
     */
    public function setCreateCustomerResult($CreateCustomerResult)
    {
      $this->CreateCustomerResult = $CreateCustomerResult;
      return $this;
    }

}
