<?php

namespace Visual\CustomerService;

class LoadCustomerDataByOrderID2Response
{

    /**
     * @var CustomerData $LoadCustomerDataByOrderID2Result
     */
    protected $LoadCustomerDataByOrderID2Result = null;

    /**
     * @param CustomerData $LoadCustomerDataByOrderID2Result
     */
    public function __construct($LoadCustomerDataByOrderID2Result)
    {
      $this->LoadCustomerDataByOrderID2Result = $LoadCustomerDataByOrderID2Result;
    }

    /**
     * @return CustomerData
     */
    public function getLoadCustomerDataByOrderID2Result()
    {
      return $this->LoadCustomerDataByOrderID2Result;
    }

    /**
     * @param CustomerData $LoadCustomerDataByOrderID2Result
     * @return \Visual\CustomerService\LoadCustomerDataByOrderID2Response
     */
    public function setLoadCustomerDataByOrderID2Result($LoadCustomerDataByOrderID2Result)
    {
      $this->LoadCustomerDataByOrderID2Result = $LoadCustomerDataByOrderID2Result;
      return $this;
    }

}
