<?php

namespace Visual\SalesOrderService;

class SampleCUDFOrder
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
     * @return \Visual\SalesOrderService\SampleCUDFOrder
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
     * @return \Visual\SalesOrderService\SampleCUDFOrder
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
     * @return \Visual\SalesOrderService\SampleCUDFOrder
     */
    public function setSite_ID($Site_ID)
    {
      $this->Site_ID = $Site_ID;
      return $this;
    }

}
