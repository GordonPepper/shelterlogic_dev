<?php

namespace Visual\CustomerService;

class TestLoadCustomerDataByShipTOResponse
{

    /**
     * @var CustomerData $TestLoadCustomerDataByShipTOResult
     */
    protected $TestLoadCustomerDataByShipTOResult = null;

    /**
     * @param CustomerData $TestLoadCustomerDataByShipTOResult
     */
    public function __construct($TestLoadCustomerDataByShipTOResult)
    {
      $this->TestLoadCustomerDataByShipTOResult = $TestLoadCustomerDataByShipTOResult;
    }

    /**
     * @return CustomerData
     */
    public function getTestLoadCustomerDataByShipTOResult()
    {
      return $this->TestLoadCustomerDataByShipTOResult;
    }

    /**
     * @param CustomerData $TestLoadCustomerDataByShipTOResult
     * @return \Visual\CustomerService\TestLoadCustomerDataByShipTOResponse
     */
    public function setTestLoadCustomerDataByShipTOResult($TestLoadCustomerDataByShipTOResult)
    {
      $this->TestLoadCustomerDataByShipTOResult = $TestLoadCustomerDataByShipTOResult;
      return $this;
    }

}
