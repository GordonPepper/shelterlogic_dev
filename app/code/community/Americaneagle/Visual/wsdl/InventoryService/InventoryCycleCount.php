<?php

namespace Visual\InventoryService;

class InventoryCycleCount
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
     * @return \Visual\InventoryService\InventoryCycleCount
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
     * @return \Visual\InventoryService\InventoryCycleCount
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
     * @return \Visual\InventoryService\InventoryCycleCount
     */
    public function setQuantity($Quantity)
    {
      $this->Quantity = $Quantity;
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
     * @return \Visual\InventoryService\InventoryCycleCount
     */
    public function setDescription($Description)
    {
      $this->Description = $Description;
      return $this;
    }

}
