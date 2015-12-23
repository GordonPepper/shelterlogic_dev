<?php

namespace Visual\SalesOrderService;

class SearchCustomerOrderLike
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
     * @return \Visual\SalesOrderService\SearchCustomerOrderLike
     */
    public function setData($data)
    {
      $this->data = $data;
      return $this;
    }

}
