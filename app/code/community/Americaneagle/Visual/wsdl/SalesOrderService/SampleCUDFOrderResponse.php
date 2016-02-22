<?php

namespace Visual\SalesOrderService;

class SampleCUDFOrderResponse
{

    /**
     * @var CustomerOrderData $SampleCUDFOrderResult
     */
    protected $SampleCUDFOrderResult = null;

    /**
     * @param CustomerOrderData $SampleCUDFOrderResult
     */
    public function __construct($SampleCUDFOrderResult)
    {
      $this->SampleCUDFOrderResult = $SampleCUDFOrderResult;
    }

    /**
     * @return CustomerOrderData
     */
    public function getSampleCUDFOrderResult()
    {
      return $this->SampleCUDFOrderResult;
    }

    /**
     * @param CustomerOrderData $SampleCUDFOrderResult
     * @return \Visual\SalesOrderService\SampleCUDFOrderResponse
     */
    public function setSampleCUDFOrderResult($SampleCUDFOrderResult)
    {
      $this->SampleCUDFOrderResult = $SampleCUDFOrderResult;
      return $this;
    }

}
