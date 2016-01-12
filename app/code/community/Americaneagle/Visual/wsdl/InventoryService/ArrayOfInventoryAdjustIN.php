<?php

namespace Visual\InventoryService;

class ArrayOfInventoryAdjustIN
{

    /**
     * @var InventoryAdjustIN[] $InventoryAdjustIN
     */
    protected $InventoryAdjustIN = null;

    
    public function __construct()
    {
    
    }

    /**
     * @return InventoryAdjustIN[]
     */
    public function getInventoryAdjustIN()
    {
      return $this->InventoryAdjustIN;
    }

    /**
     * @param InventoryAdjustIN[] $InventoryAdjustIN
     * @return \Visual\InventoryService\ArrayOfInventoryAdjustIN
     */
    public function setInventoryAdjustIN(array $InventoryAdjustIN = null)
    {
      $this->InventoryAdjustIN = $InventoryAdjustIN;
      return $this;
    }

}
