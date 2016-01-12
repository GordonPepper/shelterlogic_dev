<?php

namespace Visual\SalesOrderService;

class SampleOrderCD65
{

    /**
     * @var string $orderID
     */
    protected $orderID = null;

    /**
     * @var string $customerID
     */
    protected $customerID = null;

    /**
     * @var string $Site_ID
     */
    protected $Site_ID = null;

    /**
     * @param string $orderID
     * @param string $customerID
     * @param string $Site_ID
     */
    public function __construct($orderID, $customerID, $Site_ID)
    {
      $this->orderID = $orderID;
      $this->customerID = $customerID;
      $this->Site_ID = $Site_ID;
    }

    /**
     * @return string
     */
    public function getOrderID()
    {
      return $this->orderID;
    }

    /**
     * @param string $orderID
     * @return \Visual\SalesOrderService\SampleOrderCD65
     */
    public function setOrderID($orderID)
    {
      $this->orderID = $orderID;
      return $this;
    }

    /**
     * @return string
     */
    public function getCustomerID()
    {
      return $this->customerID;
    }

    /**
     * @param string $customerID
     * @return \Visual\SalesOrderService\SampleOrderCD65
     */
    public function setCustomerID($customerID)
    {
      $this->customerID = $customerID;
      return $this;
    }

    /**
     * @return string
     */
    public function getSite_ID()
    {
      return $this->Site_ID;
    }

    /**
     * @param string $Site_ID
     * @return \Visual\SalesOrderService\SampleOrderCD65
     */
    public function setSite_ID($Site_ID)
    {
      $this->Site_ID = $Site_ID;
      return $this;
    }

}
