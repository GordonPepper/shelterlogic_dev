<?php

namespace Visual\CustomerService;

class TestUpdateCustomerAddressResponse
{

    /**
     * @var CustomerData $TestUpdateCustomerAddressResult
     */
    protected $TestUpdateCustomerAddressResult = null;

    /**
     * @param CustomerData $TestUpdateCustomerAddressResult
     */
    public function __construct($TestUpdateCustomerAddressResult)
    {
      $this->TestUpdateCustomerAddressResult = $TestUpdateCustomerAddressResult;
    }

    /**
     * @return CustomerData
     */
    public function getTestUpdateCustomerAddressResult()
    {
      return $this->TestUpdateCustomerAddressResult;
    }

    /**
     * @param CustomerData $TestUpdateCustomerAddressResult
     * @return \Visual\CustomerService\TestUpdateCustomerAddressResponse
     */
    public function setTestUpdateCustomerAddressResult($TestUpdateCustomerAddressResult)
    {
      $this->TestUpdateCustomerAddressResult = $TestUpdateCustomerAddressResult;
      return $this;
    }

}
