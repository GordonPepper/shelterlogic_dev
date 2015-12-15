<?php

namespace Visual\InventoryService;

class InventoryTransactionData
{

    /**
     * @var ArrayOfInventoryTransfer $Transfers
     */
    protected $Transfers = null;

    /**
     * @var ArrayOfInventoryAdjustIN $AdjustINs
     */
    protected $AdjustINs = null;

    /**
     * @var ArrayOfInventoryAdjustOUT $AdjustOUTs
     */
    protected $AdjustOUTs = null;

    /**
     * @var ArrayOfInventoryMaterialIssue $MaterialIssues
     */
    protected $MaterialIssues = null;

    /**
     * @var ArrayOfInventoryWOReceipt $WOReceipts
     */
    protected $WOReceipts = null;

    
    public function __construct()
    {
    
    }

    /**
     * @return ArrayOfInventoryTransfer
     */
    public function getTransfers()
    {
      return $this->Transfers;
    }

    /**
     * @param ArrayOfInventoryTransfer $Transfers
     * @return \Visual\InventoryService\InventoryTransactionData
     */
    public function setTransfers($Transfers)
    {
      $this->Transfers = $Transfers;
      return $this;
    }

    /**
     * @return ArrayOfInventoryAdjustIN
     */
    public function getAdjustINs()
    {
      return $this->AdjustINs;
    }

    /**
     * @param ArrayOfInventoryAdjustIN $AdjustINs
     * @return \Visual\InventoryService\InventoryTransactionData
     */
    public function setAdjustINs($AdjustINs)
    {
      $this->AdjustINs = $AdjustINs;
      return $this;
    }

    /**
     * @return ArrayOfInventoryAdjustOUT
     */
    public function getAdjustOUTs()
    {
      return $this->AdjustOUTs;
    }

    /**
     * @param ArrayOfInventoryAdjustOUT $AdjustOUTs
     * @return \Visual\InventoryService\InventoryTransactionData
     */
    public function setAdjustOUTs($AdjustOUTs)
    {
      $this->AdjustOUTs = $AdjustOUTs;
      return $this;
    }

    /**
     * @return ArrayOfInventoryMaterialIssue
     */
    public function getMaterialIssues()
    {
      return $this->MaterialIssues;
    }

    /**
     * @param ArrayOfInventoryMaterialIssue $MaterialIssues
     * @return \Visual\InventoryService\InventoryTransactionData
     */
    public function setMaterialIssues($MaterialIssues)
    {
      $this->MaterialIssues = $MaterialIssues;
      return $this;
    }

    /**
     * @return ArrayOfInventoryWOReceipt
     */
    public function getWOReceipts()
    {
      return $this->WOReceipts;
    }

    /**
     * @param ArrayOfInventoryWOReceipt $WOReceipts
     * @return \Visual\InventoryService\InventoryTransactionData
     */
    public function setWOReceipts($WOReceipts)
    {
      $this->WOReceipts = $WOReceipts;
      return $this;
    }

}
