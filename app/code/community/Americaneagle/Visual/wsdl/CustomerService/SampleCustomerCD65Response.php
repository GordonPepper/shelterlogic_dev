<?php

namespace Visual\CustomerService;

class SampleCustomerCD65Response
{

    /**
     * @var CustomerData $SampleCustomerCD65Result
     */
    protected $SampleCustomerCD65Result = null;

    /**
     * @param CustomerData $SampleCustomerCD65Result
     */
    public function __construct($SampleCustomerCD65Result)
    {
      $this->SampleCustomerCD65Result = $SampleCustomerCD65Result;
    }

    /**
     * @return CustomerData
     */
    public function getSampleCustomerCD65Result()
    {
      return $this->SampleCustomerCD65Result;
    }

    /**
     * @param CustomerData $SampleCustomerCD65Result
     * @return \Visual\CustomerService\SampleCustomerCD65Response
     */
    public function setSampleCustomerCD65Result($SampleCustomerCD65Result)
    {
      $this->SampleCustomerCD65Result = $SampleCustomerCD65Result;
      return $this;
    }

}
