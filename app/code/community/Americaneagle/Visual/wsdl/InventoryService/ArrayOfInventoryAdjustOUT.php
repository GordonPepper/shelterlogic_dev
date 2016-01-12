<?php

namespace Visual\InventoryService;

class ArrayOfInventoryAdjustOUT
{

    /**
     * @var InventoryAdjustOUT[] $InventoryAdjustOUT
     */
    protected $InventoryAdjustOUT = null;

    
    public function __construct()
    {
    
    }

    /**
     * @return InventoryAdjustOUT[]
     */
    public function getInventoryAdjustOUT()
    {
      return $this->InventoryAdjustOUT;
    }

    /**
     * @param InventoryAdjustOUT[] $InventoryAdjustOUT
     * @return \Visual\InventoryService\ArrayOfInventoryAdjustOUT
     */
    public function setInventoryAdjustOUT(array $InventoryAdjustOUT = null)
    {
      $this->InventoryAdjustOUT = $InventoryAdjustOUT;
      return $this;
    }

}
