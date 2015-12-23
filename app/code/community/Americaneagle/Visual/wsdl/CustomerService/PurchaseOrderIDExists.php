<?php

namespace Visual\CustomerService;

class PurchaseOrderIDExists
{

    /**
     * @var string $customerID
     */
    protected $customerID = null;

    /**
     * @var string $purchaseOrderID
     */
    protected $purchaseOrderID = null;

    /**
     * @param string $customerID
     * @param string $purchaseOrderID
     */
    public function __construct($customerID, $purchaseOrderID)
    {
      $this->customerID = $customerID;
      $this->purchaseOrderID = $purchaseOrderID;
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
     * @return \Visual\CustomerService\PurchaseOrderIDExists
     */
    public function setCustomerID($customerID)
    {
      $this->customerID = $customerID;
      return $this;
    }

    /**
     * @return string
     */
    public function getPurchaseOrderID()
    {
      return $this->purchaseOrderID;
    }

    /**
     * @param string $purchaseOrderID
     * @return \Visual\CustomerService\PurchaseOrderIDExists
     */
    public function setPurchaseOrderID($purchaseOrderID)
    {
      $this->purchaseOrderID = $purchaseOrderID;
      return $this;
    }

}
