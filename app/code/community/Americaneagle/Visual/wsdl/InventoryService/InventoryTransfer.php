<?php

namespace Visual\InventoryService;

class InventoryTransfer
{

    /**
     * @var \DateTime $TransactionDate
     */
    protected $TransactionDate = null;

    /**
     * @var string $PartID
     */
    protected $PartID = null;

    /**
     * @var float $Quantity
     */
    protected $Quantity = null;

    /**
     * @var string $FromWarehouse
     */
    protected $FromWarehouse = null;

    /**
     * @var string $FromLocation
     */
    protected $FromLocation = null;

    /**
     * @var string $ToWarehouse
     */
    protected $ToWarehouse = null;

    /**
     * @var string $ToLocation
     */
    protected $ToLocation = null;

    /**
     * @param float $Quantity
     */
    public function __construct($Quantity)
    {
      $this->Quantity = $Quantity;
    }

    /**
     * @return \DateTime
     */
    public function getTransactionDate()
    {
      if ($this->TransactionDate == null) {
        return null;
      } else {
        try {
          return new \DateTime($this->TransactionDate);
        } catch (\Exception $e) {
          return false;
        }
      }
    }

    /**
     * @param \DateTime $TransactionDate
     * @return \Visual\InventoryService\InventoryTransfer
     */
    public function setTransactionDate(\DateTime $TransactionDate = null)
    {
      if ($TransactionDate == null) {
       $this->TransactionDate = null;
      } else {
        $this->TransactionDate = $TransactionDate->format(\DateTime::ATOM);
      }
      return $this;
    }

    /**
     * @return string
     */
    public function getPartID()
    {
      return $this->PartID;
    }

    /**
     * @param string $PartID
     * @return \Visual\InventoryService\InventoryTransfer
     */
    public function setPartID($PartID)
    {
      $this->PartID = $PartID;
      return $this;
    }

    /**
     * @return float
     */
    public function getQuantity()
    {
      return $this->Quantity;
    }

    /**
     * @param float $Quantity
     * @return \Visual\InventoryService\InventoryTransfer
     */
    public function setQuantity($Quantity)
    {
      $this->Quantity = $Quantity;
      return $this;
    }

    /**
     * @return string
     */
    public function getFromWarehouse()
    {
      return $this->FromWarehouse;
    }

    /**
     * @param string $FromWarehouse
     * @return \Visual\InventoryService\InventoryTransfer
     */
    public function setFromWarehouse($FromWarehouse)
    {
      $this->FromWarehouse = $FromWarehouse;
      return $this;
    }

    /**
     * @return string
     */
    public function getFromLocation()
    {
      return $this->FromLocation;
    }

    /**
     * @param string $FromLocation
     * @return \Visual\InventoryService\InventoryTransfer
     */
    public function setFromLocation($FromLocation)
    {
      $this->FromLocation = $FromLocation;
      return $this;
    }

    /**
     * @return string
     */
    public function getToWarehouse()
    {
      return $this->ToWarehouse;
    }

    /**
     * @param string $ToWarehouse
     * @return \Visual\InventoryService\InventoryTransfer
     */
    public function setToWarehouse($ToWarehouse)
    {
      $this->ToWarehouse = $ToWarehouse;
      return $this;
    }

    /**
     * @return string
     */
    public function getToLocation()
    {
      return $this->ToLocation;
    }

    /**
     * @param string $ToLocation
     * @return \Visual\InventoryService\InventoryTransfer
     */
    public function setToLocation($ToLocation)
    {
      $this->ToLocation = $ToLocation;
      return $this;
    }

}
