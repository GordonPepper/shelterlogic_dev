<?php

namespace Visual\SalesOrderService;

class ArrayOfCustomerOrderHeaderResponse
{

    /**
     * @var CustomerOrderHeaderResponse[] $CustomerOrderHeaderResponse
     */
    protected $CustomerOrderHeaderResponse = null;

    
    public function __construct()
    {
    
    }

    /**
     * @return CustomerOrderHeaderResponse[]
     */
    public function getCustomerOrderHeaderResponse()
    {
      return $this->CustomerOrderHeaderResponse;
    }

    /**
     * @param CustomerOrderHeaderResponse[] $CustomerOrderHeaderResponse
     * @return \Visual\SalesOrderService\ArrayOfCustomerOrderHeaderResponse
     */
    public function setCustomerOrderHeaderResponse(array $CustomerOrderHeaderResponse = null)
    {
      $this->CustomerOrderHeaderResponse = $CustomerOrderHeaderResponse;
      return $this;
    }

}
