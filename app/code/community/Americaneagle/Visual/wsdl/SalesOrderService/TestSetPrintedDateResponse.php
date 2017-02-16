<?php

namespace Visual\SalesOrderService;

class TestSetPrintedDateResponse
{

    /**
     * @var CustomerOrderDataResponse $TestSetPrintedDateResult
     */
    protected $TestSetPrintedDateResult = null;

    /**
     * @param CustomerOrderDataResponse $TestSetPrintedDateResult
     */
    public function __construct($TestSetPrintedDateResult)
    {
      $this->TestSetPrintedDateResult = $TestSetPrintedDateResult;
    }

    /**
     * @return CustomerOrderDataResponse
     */
    public function getTestSetPrintedDateResult()
    {
      return $this->TestSetPrintedDateResult;
    }

    /**
     * @param CustomerOrderDataResponse $TestSetPrintedDateResult
     * @return \Visual\SalesOrderService\TestSetPrintedDateResponse
     */
    public function setTestSetPrintedDateResult($TestSetPrintedDateResult)
    {
      $this->TestSetPrintedDateResult = $TestSetPrintedDateResult;
      return $this;
    }

}
