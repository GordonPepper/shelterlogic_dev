<?php

namespace Visual\InventoryService;

class ArrayOfInventoryCycleCount
{

    /**
     * @var InventoryCycleCount[] $InventoryCycleCount
     */
    protected $InventoryCycleCount = null;

    
    public function __construct()
    {
    
    }

    /**
     * @return InventoryCycleCount[]
     */
    public function getInventoryCycleCount()
    {
      return $this->InventoryCycleCount;
    }

    /**
     * @param InventoryCycleCount[] $InventoryCycleCount
     * @return \Visual\InventoryService\ArrayOfInventoryCycleCount
     */
    public function setInventoryCycleCount(array $InventoryCycleCount = null)
    {
      $this->InventoryCycleCount = $InventoryCycleCount;
      return $this;
    }

}
