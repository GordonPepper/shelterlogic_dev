<?php

namespace Visual\CustomerService;

class LoadCustomerDataByOrderIDResponse
{

    /**
     * @var CustomerData $LoadCustomerDataByOrderIDResult
     */
    protected $LoadCustomerDataByOrderIDResult = null;

    /**
     * @param CustomerData $LoadCustomerDataByOrderIDResult
     */
    public function __construct($LoadCustomerDataByOrderIDResult)
    {
      $this->LoadCustomerDataByOrderIDResult = $LoadCustomerDataByOrderIDResult;
    }

    /**
     * @return CustomerData
     */
    public function getLoadCustomerDataByOrderIDResult()
    {
      return $this->LoadCustomerDataByOrderIDResult;
    }

    /**
     * @param CustomerData $LoadCustomerDataByOrderIDResult
     * @return \Visual\CustomerService\LoadCustomerDataByOrderIDResponse
     */
    public function setLoadCustomerDataByOrderIDResult($LoadCustomerDataByOrderIDResult)
    {
      $this->LoadCustomerDataByOrderIDResult = $LoadCustomerDataByOrderIDResult;
      return $this;
    }

}
