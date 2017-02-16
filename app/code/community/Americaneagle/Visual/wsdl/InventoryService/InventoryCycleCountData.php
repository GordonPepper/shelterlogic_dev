<?php

namespace Visual\InventoryService;

class InventoryCycleCountData
{

    /**
     * @var string $Warehouse
     */
    protected $Warehouse = null;

    /**
     * @var string $Location
     */
    protected $Location = null;

    /**
     * @var ArrayOfInventoryCycleCount $CycleCounts
     */
    protected $CycleCounts = null;

    
    public function __construct()
    {
    
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
     * @return \Visual\InventoryService\InventoryCycleCountData
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
     * @return \Visual\InventoryService\InventoryCycleCountData
     */
    public function setLocation($Location)
    {
      $this->Location = $Location;
      return $this;
    }

    /**
     * @return ArrayOfInventoryCycleCount
     */
    public function getCycleCounts()
    {
      return $this->CycleCounts;
    }

    /**
     * @param ArrayOfInventoryCycleCount $CycleCounts
     * @return \Visual\InventoryService\InventoryCycleCountData
     */
    public function setCycleCounts($CycleCounts)
    {
      $this->CycleCounts = $CycleCounts;
      return $this;
    }

}
