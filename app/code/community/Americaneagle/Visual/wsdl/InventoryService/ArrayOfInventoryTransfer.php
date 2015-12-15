<?php

namespace Visual\InventoryService;

class ArrayOfInventoryTransfer
{

    /**
     * @var InventoryTransfer[] $InventoryTransfer
     */
    protected $InventoryTransfer = null;

    
    public function __construct()
    {
    
    }

    /**
     * @return InventoryTransfer[]
     */
    public function getInventoryTransfer()
    {
      return $this->InventoryTransfer;
    }

    /**
     * @param InventoryTransfer[] $InventoryTransfer
     * @return \Visual\InventoryService\ArrayOfInventoryTransfer
     */
    public function setInventoryTransfer(array $InventoryTransfer = null)
    {
      $this->InventoryTransfer = $InventoryTransfer;
      return $this;
    }

}
