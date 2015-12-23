<?php

namespace Visual\SalesOrderService;

class CDStoreSampleResponse
{

    /**
     * @var CustomerOrderData $CDStoreSampleResult
     */
    protected $CDStoreSampleResult = null;

    /**
     * @param CustomerOrderData $CDStoreSampleResult
     */
    public function __construct($CDStoreSampleResult)
    {
      $this->CDStoreSampleResult = $CDStoreSampleResult;
    }

    /**
     * @return CustomerOrderData
     */
    public function getCDStoreSampleResult()
    {
      return $this->CDStoreSampleResult;
    }

    /**
     * @param CustomerOrderData $CDStoreSampleResult
     * @return \Visual\SalesOrderService\CDStoreSampleResponse
     */
    public function setCDStoreSampleResult($CDStoreSampleResult)
    {
      $this->CDStoreSampleResult = $CDStoreSampleResult;
      return $this;
    }

}
