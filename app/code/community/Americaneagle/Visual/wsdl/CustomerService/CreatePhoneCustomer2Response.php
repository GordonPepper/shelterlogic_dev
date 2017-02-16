<?php

namespace Visual\CustomerService;

class CreatePhoneCustomer2Response
{

    /**
     * @var CustomerData $CreatePhoneCustomer2Result
     */
    protected $CreatePhoneCustomer2Result = null;

    /**
     * @param CustomerData $CreatePhoneCustomer2Result
     */
    public function __construct($CreatePhoneCustomer2Result)
    {
      $this->CreatePhoneCustomer2Result = $CreatePhoneCustomer2Result;
    }

    /**
     * @return CustomerData
     */
    public function getCreatePhoneCustomer2Result()
    {
      return $this->CreatePhoneCustomer2Result;
    }

    /**
     * @param CustomerData $CreatePhoneCustomer2Result
     * @return \Visual\CustomerService\CreatePhoneCustomer2Response
     */
    public function setCreatePhoneCustomer2Result($CreatePhoneCustomer2Result)
    {
      $this->CreatePhoneCustomer2Result = $CreatePhoneCustomer2Result;
      return $this;
    }

}
