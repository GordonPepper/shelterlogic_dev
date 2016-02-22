<?php

namespace Visual\CustomerService;

class LokupWarehouseByIDResponse
{

    /**
     * @var string $LokupWarehouseByIDResult
     */
    protected $LokupWarehouseByIDResult = null;

    /**
     * @param string $LokupWarehouseByIDResult
     */
    public function __construct($LokupWarehouseByIDResult)
    {
      $this->LokupWarehouseByIDResult = $LokupWarehouseByIDResult;
    }

    /**
     * @return string
     */
    public function getLokupWarehouseByIDResult()
    {
      return $this->LokupWarehouseByIDResult;
    }

    /**
     * @param string $LokupWarehouseByIDResult
     * @return \Visual\CustomerService\LokupWarehouseByIDResponse
     */
    public function setLokupWarehouseByIDResult($LokupWarehouseByIDResult)
    {
      $this->LokupWarehouseByIDResult = $LokupWarehouseByIDResult;
      return $this;
    }

}
