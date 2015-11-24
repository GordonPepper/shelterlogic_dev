<?php

namespace Visual\CustomerService;

class LoadCustomerDataByShipTOResponse
{

    /**
     * @var CustomerData $LoadCustomerDataByShipTOResult
     */
    protected $LoadCustomerDataByShipTOResult = null;

    /**
     * @param CustomerData $LoadCustomerDataByShipTOResult
     */
    public function __construct($LoadCustomerDataByShipTOResult)
    {
      $this->LoadCustomerDataByShipTOResult = $LoadCustomerDataByShipTOResult;
    }

    /**
     * @return CustomerData
     */
    public function getLoadCustomerDataByShipTOResult()
    {
      return $this->LoadCustomerDataByShipTOResult;
    }

    /**
     * @param CustomerData $LoadCustomerDataByShipTOResult
     * @return \Visual\CustomerService\LoadCustomerDataByShipTOResponse
     */
    public function setLoadCustomerDataByShipTOResult($LoadCustomerDataByShipTOResult)
    {
      $this->LoadCustomerDataByShipTOResult = $LoadCustomerDataByShipTOResult;
      return $this;
    }

}
