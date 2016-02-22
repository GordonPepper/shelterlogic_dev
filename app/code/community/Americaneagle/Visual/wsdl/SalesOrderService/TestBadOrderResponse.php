<?php

namespace Visual\SalesOrderService;

class TestBadOrderResponse
{

    /**
     * @var CustomerOrderDataResponse $TestBadOrderResult
     */
    protected $TestBadOrderResult = null;

    /**
     * @param CustomerOrderDataResponse $TestBadOrderResult
     */
    public function __construct($TestBadOrderResult)
    {
      $this->TestBadOrderResult = $TestBadOrderResult;
    }

    /**
     * @return CustomerOrderDataResponse
     */
    public function getTestBadOrderResult()
    {
      return $this->TestBadOrderResult;
    }

    /**
     * @param CustomerOrderDataResponse $TestBadOrderResult
     * @return \Visual\SalesOrderService\TestBadOrderResponse
     */
    public function setTestBadOrderResult($TestBadOrderResult)
    {
      $this->TestBadOrderResult = $TestBadOrderResult;
      return $this;
    }

}
