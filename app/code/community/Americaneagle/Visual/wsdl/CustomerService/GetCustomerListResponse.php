<?php

namespace Visual\CustomerService;

class GetCustomerListResponse
{

    /**
     * @var CustomerDataResponse $GetCustomerListResult
     */
    protected $GetCustomerListResult = null;

    /**
     * @param CustomerDataResponse $GetCustomerListResult
     */
    public function __construct($GetCustomerListResult)
    {
      $this->GetCustomerListResult = $GetCustomerListResult;
    }

    /**
     * @return CustomerDataResponse
     */
    public function getGetCustomerListResult()
    {
      return $this->GetCustomerListResult;
    }

    /**
     * @param CustomerDataResponse $GetCustomerListResult
     * @return \Visual\CustomerService\GetCustomerListResponse
     */
    public function setGetCustomerListResult($GetCustomerListResult)
    {
      $this->GetCustomerListResult = $GetCustomerListResult;
      return $this;
    }

}
