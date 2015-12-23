<?php

namespace Visual\CustomerService;

class AddNewAddressResponse
{

    /**
     * @var CustomerAddress $AddNewAddressResult
     */
    protected $AddNewAddressResult = null;

    /**
     * @param CustomerAddress $AddNewAddressResult
     */
    public function __construct($AddNewAddressResult)
    {
      $this->AddNewAddressResult = $AddNewAddressResult;
    }

    /**
     * @return CustomerAddress
     */
    public function getAddNewAddressResult()
    {
      return $this->AddNewAddressResult;
    }

    /**
     * @param CustomerAddress $AddNewAddressResult
     * @return \Visual\CustomerService\AddNewAddressResponse
     */
    public function setAddNewAddressResult($AddNewAddressResult)
    {
      $this->AddNewAddressResult = $AddNewAddressResult;
      return $this;
    }

}
