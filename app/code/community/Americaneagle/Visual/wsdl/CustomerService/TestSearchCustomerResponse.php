<?php

namespace Visual\CustomerService;

class TestSearchCustomerResponse
{

    /**
     * @var CustomerData $TestSearchCustomerResult
     */
    protected $TestSearchCustomerResult = null;

    /**
     * @param CustomerData $TestSearchCustomerResult
     */
    public function __construct($TestSearchCustomerResult)
    {
      $this->TestSearchCustomerResult = $TestSearchCustomerResult;
    }

    /**
     * @return CustomerData
     */
    public function getTestSearchCustomerResult()
    {
      return $this->TestSearchCustomerResult;
    }

    /**
     * @param CustomerData $TestSearchCustomerResult
     * @return \Visual\CustomerService\TestSearchCustomerResponse
     */
    public function setTestSearchCustomerResult($TestSearchCustomerResult)
    {
      $this->TestSearchCustomerResult = $TestSearchCustomerResult;
      return $this;
    }

}
