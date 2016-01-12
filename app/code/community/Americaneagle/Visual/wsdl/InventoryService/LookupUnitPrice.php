<?php

namespace Visual\InventoryService;

class LookupUnitPrice
{

    /**
     * @var string $customerID
     */
    protected $customerID = null;

    /**
     * @var string $partID
     */
    protected $partID = null;

    /**
     * @var string $um
     */
    protected $um = null;

    /**
     * @var float $qty
     */
    protected $qty = null;

    /**
     * @param string $customerID
     * @param string $partID
     * @param string $um
     * @param float $qty
     */
    public function __construct($customerID, $partID, $um, $qty)
    {
      $this->customerID = $customerID;
      $this->partID = $partID;
      $this->um = $um;
      $this->qty = $qty;
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
     * @return \Visual\InventoryService\LookupUnitPrice
     */
    public function setCustomerID($customerID)
    {
      $this->customerID = $customerID;
      return $this;
    }

    /**
     * @return string
     */
    public function getPartID()
    {
      return $this->partID;
    }

    /**
     * @param string $partID
     * @return \Visual\InventoryService\LookupUnitPrice
     */
    public function setPartID($partID)
    {
      $this->partID = $partID;
      return $this;
    }

    /**
     * @return string
     */
    public function getUm()
    {
      return $this->um;
    }

    /**
     * @param string $um
     * @return \Visual\InventoryService\LookupUnitPrice
     */
    public function setUm($um)
    {
      $this->um = $um;
      return $this;
    }

    /**
     * @return float
     */
    public function getQty()
    {
      return $this->qty;
    }

    /**
     * @param float $qty
     * @return \Visual\InventoryService\LookupUnitPrice
     */
    public function setQty($qty)
    {
      $this->qty = $qty;
      return $this;
    }

}
