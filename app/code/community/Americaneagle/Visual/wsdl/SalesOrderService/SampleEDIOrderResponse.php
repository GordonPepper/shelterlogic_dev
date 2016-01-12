<?php

namespace Visual\SalesOrderService;

class SampleEDIOrderResponse
{

    /**
     * @var CustomerOrderData $SampleEDIOrderResult
     */
    protected $SampleEDIOrderResult = null;

    /**
     * @param CustomerOrderData $SampleEDIOrderResult
     */
    public function __construct($SampleEDIOrderResult)
    {
      $this->SampleEDIOrderResult = $SampleEDIOrderResult;
    }

    /**
     * @return CustomerOrderData
     */
    public function getSampleEDIOrderResult()
    {
      return $this->SampleEDIOrderResult;
    }

    /**
     * @param CustomerOrderData $SampleEDIOrderResult
     * @return \Visual\SalesOrderService\SampleEDIOrderResponse
     */
    public function setSampleEDIOrderResult($SampleEDIOrderResult)
    {
      $this->SampleEDIOrderResult = $SampleEDIOrderResult;
      return $this;
    }

}
