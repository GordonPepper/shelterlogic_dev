<?php

namespace Visual\SalesOrderService;

class CustomerOrderData extends BaseDataRequest
{

    /**
     * @var ArrayOfCustomerOrderHeader $Orders
     */
    protected $Orders = null;

    
    public function __construct()
    {
      parent::__construct();
    }

    /**
     * @return ArrayOfCustomerOrderHeader
     */
    public function getOrders()
    {
      return $this->Orders;
    }

    /**
     * @param ArrayOfCustomerOrderHeader $Orders
     * @return \Visual\SalesOrderService\CustomerOrderData
     */
    public function setOrders($Orders)
    {
      $this->Orders = $Orders;
      return $this;
    }

}
