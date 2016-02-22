<?php

namespace Visual\CustomerService;

class TestLoadCustomerDataByOrderIDResponse
{

    /**
     * @var CustomerData $TestLoadCustomerDataByOrderIDResult
     */
    protected $TestLoadCustomerDataByOrderIDResult = null;

    /**
     * @param CustomerData $TestLoadCustomerDataByOrderIDResult
     */
    public function __construct($TestLoadCustomerDataByOrderIDResult)
    {
      $this->TestLoadCustomerDataByOrderIDResult = $TestLoadCustomerDataByOrderIDResult;
    }

    /**
     * @return CustomerData
     */
    public function getTestLoadCustomerDataByOrderIDResult()
    {
      return $this->TestLoadCustomerDataByOrderIDResult;
    }

    /**
     * @param CustomerData $TestLoadCustomerDataByOrderIDResult
     * @return \Visual\CustomerService\TestLoadCustomerDataByOrderIDResponse
     */
    public function setTestLoadCustomerDataByOrderIDResult($TestLoadCustomerDataByOrderIDResult)
    {
      $this->TestLoadCustomerDataByOrderIDResult = $TestLoadCustomerDataByOrderIDResult;
      return $this;
    }

}
