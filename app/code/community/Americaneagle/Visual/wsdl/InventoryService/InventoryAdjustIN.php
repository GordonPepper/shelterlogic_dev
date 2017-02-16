<?php

namespace Visual\InventoryService;

class InventoryAdjustIN
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
     * @var string $Warehouse
     */
    protected $Warehouse = null;

    /**
     * @var string $Location
     */
    protected $Location = null;

    /**
     * @var string $Description
     */
    protected $Description = null;

    /**
     * @var float $UnitCost
     */
    protected $UnitCost = null;

    /**
     * @var string $AdjustmentReason
     */
    protected $AdjustmentReason = null;

    /**
     * @var string $AdjustmentAccountID
     */
    protected $AdjustmentAccountID = null;

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
     * @return \Visual\InventoryService\InventoryAdjustIN
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
     * @return \Visual\InventoryService\InventoryAdjustIN
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
     * @return \Visual\InventoryService\InventoryAdjustIN
     */
    public function setQuantity($Quantity)
    {
      $this->Quantity = $Quantity;
      return $this;
    }

    /**
     * @return string
     */
    public function getWarehouse()
    {
      return $this->Warehouse;
    }

    /**
     * @param string $Warehouse
     * @return \Visual\InventoryService\InventoryAdjustIN
     */
    public function setWarehouse($Warehouse)
    {
      $this->Warehouse = $Warehouse;
      return $this;
    }

    /**
     * @return string
     */
    public function getLocation()
    {
      return $this->Location;
    }

    /**
     * @param string $Location
     * @return \Visual\InventoryService\InventoryAdjustIN
     */
    public function setLocation($Location)
    {
      $this->Location = $Location;
      return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
      return $this->Description;
    }

    /**
     * @param string $Description
     * @return \Visual\InventoryService\InventoryAdjustIN
     */
    public function setDescription($Description)
    {
      $this->Description = $Description;
      return $this;
    }

    /**
     * @return float
     */
    public function getUnitCost()
    {
      return $this->UnitCost;
    }

    /**
     * @param float $UnitCost
     * @return \Visual\InventoryService\InventoryAdjustIN
     */
    public function setUnitCost($UnitCost)
    {
      $this->UnitCost = $UnitCost;
      return $this;
    }

    /**
     * @return string
     */
    public function getAdjustmentReason()
    {
      return $this->AdjustmentReason;
    }

    /**
     * @param string $AdjustmentReason
     * @return \Visual\InventoryService\InventoryAdjustIN
     */
    public function setAdjustmentReason($AdjustmentReason)
    {
      $this->AdjustmentReason = $AdjustmentReason;
      return $this;
    }

    /**
     * @return string
     */
    public function getAdjustmentAccountID()
    {
      return $this->AdjustmentAccountID;
    }

    /**
     * @param string $AdjustmentAccountID
     * @return \Visual\InventoryService\InventoryAdjustIN
     */
    public function setAdjustmentAccountID($AdjustmentAccountID)
    {
      $this->AdjustmentAccountID = $AdjustmentAccountID;
      return $this;
    }

}
