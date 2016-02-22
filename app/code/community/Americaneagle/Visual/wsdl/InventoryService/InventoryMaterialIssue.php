<?php

namespace Visual\InventoryService;

class InventoryMaterialIssue
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
     * @var string $SubID
     */
    protected $SubID = null;

    /**
     * @var float $SequenceNo
     */
    protected $SequenceNo = null;

    /**
     * @var float $PieceNo
     */
    protected $PieceNo = null;

    /**
     * @var string $Description
     */
    protected $Description = null;

    /**
     * @var string $IssueReason
     */
    protected $IssueReason = null;

    /**
     * @param float $Quantity
     * @param float $SequenceNo
     * @param float $PieceNo
     */
    public function __construct($Quantity, $SequenceNo, $PieceNo)
    {
      $this->Quantity = $Quantity;
      $this->SequenceNo = $SequenceNo;
      $this->PieceNo = $PieceNo;
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
     * @return \Visual\InventoryService\InventoryMaterialIssue
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
     * @return \Visual\InventoryService\InventoryMaterialIssue
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
     * @return \Visual\InventoryService\InventoryMaterialIssue
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
     * @return \Visual\InventoryService\InventoryMaterialIssue
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
     * @return \Visual\InventoryService\InventoryMaterialIssue
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
     * @return \Visual\InventoryService\InventoryMaterialIssue
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
     * @return \Visual\InventoryService\InventoryMaterialIssue
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
     * @return \Visual\InventoryService\InventoryMaterialIssue
     */
    public function setSplitID($SplitID)
    {
      $this->SplitID = $SplitID;
      return $this;
    }

    /**
     * @return string
     */
    public function getSubID()
    {
      return $this->SubID;
    }

    /**
     * @param string $SubID
     * @return \Visual\InventoryService\InventoryMaterialIssue
     */
    public function setSubID($SubID)
    {
      $this->SubID = $SubID;
      return $this;
    }

    /**
     * @return float
     */
    public function getSequenceNo()
    {
      return $this->SequenceNo;
    }

    /**
     * @param float $SequenceNo
     * @return \Visual\InventoryService\InventoryMaterialIssue
     */
    public function setSequenceNo($SequenceNo)
    {
      $this->SequenceNo = $SequenceNo;
      return $this;
    }

    /**
     * @return float
     */
    public function getPieceNo()
    {
      return $this->PieceNo;
    }

    /**
     * @param float $PieceNo
     * @return \Visual\InventoryService\InventoryMaterialIssue
     */
    public function setPieceNo($PieceNo)
    {
      $this->PieceNo = $PieceNo;
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
     * @return \Visual\InventoryService\InventoryMaterialIssue
     */
    public function setDescription($Description)
    {
      $this->Description = $Description;
      return $this;
    }

    /**
     * @return string
     */
    public function getIssueReason()
    {
      return $this->IssueReason;
    }

    /**
     * @param string $IssueReason
     * @return \Visual\InventoryService\InventoryMaterialIssue
     */
    public function setIssueReason($IssueReason)
    {
      $this->IssueReason = $IssueReason;
      return $this;
    }

}
