<?php

namespace Visual\SalesOrderService;

class CreateSalesOrder
{

    /**
     * @var CustomerOrderData $data
     */
    protected $data = null;

    /**
     * @param CustomerOrderData $data
     */
    public function __construct($data)
    {
      $this->data = $data;
    }

    /**
     * @return CustomerOrderData
     */
    public function getData()
    {
      return $this->data;
    }

    /**
     * @param CustomerOrderData $data
     * @return \Visual\SalesOrderService\CreateSalesOrder
     */
    public function setData($data)
    {
      $this->data = $data;
      return $this;
    }

}
