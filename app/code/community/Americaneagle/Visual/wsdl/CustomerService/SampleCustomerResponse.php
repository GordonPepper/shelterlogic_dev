<?php

namespace Visual\CustomerService;

class SampleCustomerResponse
{

    /**
     * @var CustomerData $SampleCustomerResult
     */
    protected $SampleCustomerResult = null;

    /**
     * @param CustomerData $SampleCustomerResult
     */
    public function __construct($SampleCustomerResult)
    {
      $this->SampleCustomerResult = $SampleCustomerResult;
    }

    /**
     * @return CustomerData
     */
    public function getSampleCustomerResult()
    {
      return $this->SampleCustomerResult;
    }

    /**
     * @param CustomerData $SampleCustomerResult
     * @return \Visual\CustomerService\SampleCustomerResponse
     */
    public function setSampleCustomerResult($SampleCustomerResult)
    {
      $this->SampleCustomerResult = $SampleCustomerResult;
      return $this;
    }

}
