<?php

namespace Visual\SalesOrderService;

class CreateSalesOrder2Response
{

    /**
     * @var CustomerOrderDataResponse $CreateSalesOrder2Result
     */
    protected $CreateSalesOrder2Result = null;

    /**
     * @param CustomerOrderDataResponse $CreateSalesOrder2Result
     */
    public function __construct($CreateSalesOrder2Result)
    {
      $this->CreateSalesOrder2Result = $CreateSalesOrder2Result;
    }

    /**
     * @return CustomerOrderDataResponse
     */
    public function getCreateSalesOrder2Result()
    {
      return $this->CreateSalesOrder2Result;
    }

    /**
     * @param CustomerOrderDataResponse $CreateSalesOrder2Result
     * @return \Visual\SalesOrderService\CreateSalesOrder2Response
     */
    public function setCreateSalesOrder2Result($CreateSalesOrder2Result)
    {
      $this->CreateSalesOrder2Result = $CreateSalesOrder2Result;
      return $this;
    }

}
