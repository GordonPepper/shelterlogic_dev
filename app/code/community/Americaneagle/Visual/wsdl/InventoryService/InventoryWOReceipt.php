<?php

namespace Visual\InventoryService;

class InventoryWOReceipt
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
     * @var string $WorkOrderID
     */
    protected $WorkOrderID = null;

    /**
     * @var string $LotID
     */
    protected $LotID = null;

    /**
     * @var string $SplitID
     */
    protected $SplitID = null;

    /**
     * @var string $Description
     */
    protected $Description = null;

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
     * @return \Visual\InventoryService\InventoryWOReceipt
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
     * @return \Visual\InventoryService\InventoryWOReceipt
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
     * @return \Visual\InventoryService\InventoryWOReceipt
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
     * @return \Visual\InventoryService\InventoryWOReceipt
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
     * @return \Visual\InventoryService\InventoryWOReceipt
     */
    public function setLocation($Location)
    {
      $this->Location = $Location;
      return $this;
    }

    /**
     * @return string
     */
    public function getWorkOrderID()
    {
      return $this->WorkOrderID;
    }

    /**
     * @param string $WorkOrderID
     * @return \Visual\InventoryService\InventoryWOReceipt
     */
    public function setWorkOrderID($WorkOrderID)
    {
      $this->WorkOrderID = $WorkOrderID;
      return $this;
    }

    /**
     * @return string
     */
    public function getLotID()
    {
      return $this->LotID;
    }

    /**
     * @param string $LotID
     * @return \Visual\InventoryService\InventoryWOReceipt
     */
    public function setLotID($LotID)
    {
      $this->LotID = $LotID;
      return $this;
    }

    /**
     * @return string
     */
    public function getSplitID()
    {
      return $this->SplitID;
    }

    /**
     * @param string $SplitID
     * @return \Visual\InventoryService\InventoryWOReceipt
     */
    public function setSplitID($SplitID)
    {
      $this->SplitID = $SplitID;
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
     * @return \Visual\InventoryService\InventoryWOReceipt
     */
    public function setDescription($Description)
    {
      $this->Description = $Description;
      return $this;
    }

}
