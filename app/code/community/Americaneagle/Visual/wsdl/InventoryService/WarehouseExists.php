<?php

namespace Visual\InventoryService;

class WarehouseExists
{

    /**
     * @var string $warehouseID
     */
    protected $warehouseID = null;

    /**
     * @param string $warehouseID
     */
    public function __construct($warehouseID)
    {
      $this->warehouseID = $warehouseID;
    }

    /**
     * @return string
     */
    public function getWarehouseID()
    {
      return $this->warehouseID;
    }

    /**
     * @param string $warehouseID
     * @return \Visual\InventoryService\WarehouseExists
     */
    public function setWarehouseID($warehouseID)
    {
      $this->warehouseID = $warehouseID;
      return $this;
    }

}
