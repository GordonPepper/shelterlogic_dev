<?php

namespace Visual\SalesOrderService;

class SampleOrderCD65Response
{

    /**
     * @var CustomerOrderData $SampleOrderCD65Result
     */
    protected $SampleOrderCD65Result = null;

    /**
     * @param CustomerOrderData $SampleOrderCD65Result
     */
    public function __construct($SampleOrderCD65Result)
    {
      $this->SampleOrderCD65Result = $SampleOrderCD65Result;
    }

    /**
     * @return CustomerOrderData
     */
    public function getSampleOrderCD65Result()
    {
      return $this->SampleOrderCD65Result;
    }

    /**
     * @param CustomerOrderData $SampleOrderCD65Result
     * @return \Visual\SalesOrderService\SampleOrderCD65Response
     */
    public function setSampleOrderCD65Result($SampleOrderCD65Result)
    {
      $this->SampleOrderCD65Result = $SampleOrderCD65Result;
      return $this;
    }

}
