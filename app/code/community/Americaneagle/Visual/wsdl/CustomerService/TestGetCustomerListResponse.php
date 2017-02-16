<?php

namespace Visual\CustomerService;

class TestGetCustomerListResponse
{

    /**
     * @var CustomerDataResponse $TestGetCustomerListResult
     */
    protected $TestGetCustomerListResult = null;

    /**
     * @param CustomerDataResponse $TestGetCustomerListResult
     */
    public function __construct($TestGetCustomerListResult)
    {
      $this->TestGetCustomerListResult = $TestGetCustomerListResult;
    }

    /**
     * @return CustomerDataResponse
     */
    public function getTestGetCustomerListResult()
    {
      return $this->TestGetCustomerListResult;
    }

    /**
     * @param CustomerDataResponse $TestGetCustomerListResult
     * @return \Visual\CustomerService\TestGetCustomerListResponse
     */
    public function setTestGetCustomerListResult($TestGetCustomerListResult)
    {
      $this->TestGetCustomerListResult = $TestGetCustomerListResult;
      return $this;
    }

}
