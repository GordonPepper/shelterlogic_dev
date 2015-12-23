<?php

namespace Visual\CustomerService;

class LoadCustomerDataByShipTO2Response
{

    /**
     * @var CustomerData $LoadCustomerDataByShipTO2Result
     */
    protected $LoadCustomerDataByShipTO2Result = null;

    /**
     * @param CustomerData $LoadCustomerDataByShipTO2Result
     */
    public function __construct($LoadCustomerDataByShipTO2Result)
    {
      $this->LoadCustomerDataByShipTO2Result = $LoadCustomerDataByShipTO2Result;
    }

    /**
     * @return CustomerData
     */
    public function getLoadCustomerDataByShipTO2Result()
    {
      return $this->LoadCustomerDataByShipTO2Result;
    }

    /**
     * @param CustomerData $LoadCustomerDataByShipTO2Result
     * @return \Visual\CustomerService\LoadCustomerDataByShipTO2Response
     */
    public function setLoadCustomerDataByShipTO2Result($LoadCustomerDataByShipTO2Result)
    {
      $this->LoadCustomerDataByShipTO2Result = $LoadCustomerDataByShipTO2Result;
      return $this;
    }

}
