<?php

namespace Visual\SalesOrderService;

class Test_LoadUnPrintedOrdersResponse
{

    /**
     * @var Test_LoadUnPrintedOrdersResult $Test_LoadUnPrintedOrdersResult
     */
    protected $Test_LoadUnPrintedOrdersResult = null;

    /**
     * @param Test_LoadUnPrintedOrdersResult $Test_LoadUnPrintedOrdersResult
     */
    public function __construct($Test_LoadUnPrintedOrdersResult)
    {
      $this->Test_LoadUnPrintedOrdersResult = $Test_LoadUnPrintedOrdersResult;
    }

    /**
     * @return Test_LoadUnPrintedOrdersResult
     */
    public function getTest_LoadUnPrintedOrdersResult()
    {
      return $this->Test_LoadUnPrintedOrdersResult;
    }

    /**
     * @param Test_LoadUnPrintedOrdersResult $Test_LoadUnPrintedOrdersResult
     * @return \Visual\SalesOrderService\Test_LoadUnPrintedOrdersResponse
     */
    public function setTest_LoadUnPrintedOrdersResult($Test_LoadUnPrintedOrdersResult)
    {
      $this->Test_LoadUnPrintedOrdersResult = $Test_LoadUnPrintedOrdersResult;
      return $this;
    }

}
