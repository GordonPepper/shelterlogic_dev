<?php

namespace Visual\CustomerService;

class LoadCustomerDataByWebIDResponse
{

    /**
     * @var CustomerData $LoadCustomerDataByWebIDResult
     */
    protected $LoadCustomerDataByWebIDResult = null;

    /**
     * @param CustomerData $LoadCustomerDataByWebIDResult
     */
    public function __construct($LoadCustomerDataByWebIDResult)
    {
      $this->LoadCustomerDataByWebIDResult = $LoadCustomerDataByWebIDResult;
    }

    /**
     * @return CustomerData
     */
    public function getLoadCustomerDataByWebIDResult()
    {
      return $this->LoadCustomerDataByWebIDResult;
    }

    /**
     * @param CustomerData $LoadCustomerDataByWebIDResult
     * @return \Visual\CustomerService\LoadCustomerDataByWebIDResponse
     */
    public function setLoadCustomerDataByWebIDResult($LoadCustomerDataByWebIDResult)
    {
      $this->LoadCustomerDataByWebIDResult = $LoadCustomerDataByWebIDResult;
      return $this;
    }

}
