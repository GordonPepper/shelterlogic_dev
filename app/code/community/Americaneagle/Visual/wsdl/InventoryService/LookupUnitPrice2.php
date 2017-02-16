<?php

namespace Visual\InventoryService;

class LookupUnitPrice2
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
     * @var string $key
     */
    protected $key = null;

    /**
     * @param string $customerID
     * @param string $partID
     * @param string $um
     * @param float $qty
     * @param string $key
     */
    public function __construct($customerID, $partID, $um, $qty, $key)
    {
      $this->customerID = $customerID;
      $this->partID = $partID;
      $this->um = $um;
      $this->qty = $qty;
      $this->key = $key;
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
     * @return \Visual\InventoryService\LookupUnitPrice2
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
     * @return \Visual\InventoryService\LookupUnitPrice2
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
     * @return \Visual\InventoryService\LookupUnitPrice2
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
     * @return \Visual\InventoryService\LookupUnitPrice2
     */
    public function setQty($qty)
    {
      $this->qty = $qty;
      return $this;
    }

    /**
     * @return string
     */
    public function getKey()
    {
      return $this->key;
    }

    /**
     * @param string $key
     * @return \Visual\InventoryService\LookupUnitPrice2
     */
    public function setKey($key)
    {
      $this->key = $key;
      return $this;
    }

}
