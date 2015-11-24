<?php

namespace Visual\SalesOrderService;

class CustomerOrderDataResponse extends BaseDataResponse
{

    /**
     * @var ArrayOfCustomerOrderHeaderResponse $Orders
     */
    protected $Orders = null;

    /**
     * @param boolean $HasErrors
     * @param \DateTime $SubmitDateTime
     * @param \DateTime $ResponseDateTime
     */
    public function __construct($HasErrors, \DateTime $SubmitDateTime, \DateTime $ResponseDateTime)
    {
      parent::__construct($HasErrors, $SubmitDateTime, $ResponseDateTime);
    }

    /**
     * @return ArrayOfCustomerOrderHeaderResponse
     */
    public function getOrders()
    {
      return $this->Orders;
    }

    /**
     * @param ArrayOfCustomerOrderHeaderResponse $Orders
     * @return \Visual\SalesOrderService\CustomerOrderDataResponse
     */
    public function setOrders($Orders)
    {
      $this->Orders = $Orders;
      return $this;
    }

}
