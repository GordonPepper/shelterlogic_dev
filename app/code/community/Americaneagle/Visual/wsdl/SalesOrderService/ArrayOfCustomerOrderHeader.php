<?php

namespace Visual\SalesOrderService;

class ArrayOfCustomerOrderHeader
{

    /**
     * @var CustomerOrderHeader[] $CustomerOrderHeader
     */
    protected $CustomerOrderHeader = null;

    
    public function __construct()
    {
    
    }

    /**
     * @return CustomerOrderHeader[]
     */
    public function getCustomerOrderHeader()
    {
      return $this->CustomerOrderHeader;
    }

    /**
     * @param CustomerOrderHeader[] $CustomerOrderHeader
     * @return \Visual\SalesOrderService\ArrayOfCustomerOrderHeader
     */
    public function setCustomerOrderHeader(array $CustomerOrderHeader = null)
    {
      $this->CustomerOrderHeader = $CustomerOrderHeader;
      return $this;
    }

}
