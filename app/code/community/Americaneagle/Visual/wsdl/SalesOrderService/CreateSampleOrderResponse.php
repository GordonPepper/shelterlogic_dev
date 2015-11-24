<?php

namespace Visual\SalesOrderService;

class CreateSampleOrderResponse
{

    /**
     * @var CustomerOrderDataResponse $CreateSampleOrderResult
     */
    protected $CreateSampleOrderResult = null;

    /**
     * @param CustomerOrderDataResponse $CreateSampleOrderResult
     */
    public function __construct($CreateSampleOrderResult)
    {
      $this->CreateSampleOrderResult = $CreateSampleOrderResult;
    }

    /**
     * @return CustomerOrderDataResponse
     */
    public function getCreateSampleOrderResult()
    {
      return $this->CreateSampleOrderResult;
    }

    /**
     * @param CustomerOrderDataResponse $CreateSampleOrderResult
     * @return \Visual\SalesOrderService\CreateSampleOrderResponse
     */
    public function setCreateSampleOrderResult($CreateSampleOrderResult)
    {
      $this->CreateSampleOrderResult = $CreateSampleOrderResult;
      return $this;
    }

}
