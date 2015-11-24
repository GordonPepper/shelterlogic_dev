<?php

namespace Visual\SalesOrderService;

class CreateSalesOrderResponse
{

    /**
     * @var CustomerOrderDataResponse $CreateSalesOrderResult
     */
    protected $CreateSalesOrderResult = null;

    /**
     * @param CustomerOrderDataResponse $CreateSalesOrderResult
     */
    public function __construct($CreateSalesOrderResult)
    {
      $this->CreateSalesOrderResult = $CreateSalesOrderResult;
    }

    /**
     * @return CustomerOrderDataResponse
     */
    public function getCreateSalesOrderResult()
    {
      return $this->CreateSalesOrderResult;
    }

    /**
     * @param CustomerOrderDataResponse $CreateSalesOrderResult
     * @return \Visual\SalesOrderService\CreateSalesOrderResponse
     */
    public function setCreateSalesOrderResult($CreateSalesOrderResult)
    {
      $this->CreateSalesOrderResult = $CreateSalesOrderResult;
      return $this;
    }

}
