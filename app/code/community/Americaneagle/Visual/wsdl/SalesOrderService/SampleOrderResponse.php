<?php

namespace Visual\SalesOrderService;

class SampleOrderResponse
{

    /**
     * @var CustomerOrderData $SampleOrderResult
     */
    protected $SampleOrderResult = null;

    /**
     * @param CustomerOrderData $SampleOrderResult
     */
    public function __construct($SampleOrderResult)
    {
      $this->SampleOrderResult = $SampleOrderResult;
    }

    /**
     * @return CustomerOrderData
     */
    public function getSampleOrderResult()
    {
      return $this->SampleOrderResult;
    }

    /**
     * @param CustomerOrderData $SampleOrderResult
     * @return \Visual\SalesOrderService\SampleOrderResponse
     */
    public function setSampleOrderResult($SampleOrderResult)
    {
      $this->SampleOrderResult = $SampleOrderResult;
      return $this;
    }

}
