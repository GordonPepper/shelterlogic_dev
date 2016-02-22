<?php

namespace Visual\InventoryService;

class LocationExists
{

    /**
     * @var string $warehouseID
     */
    protected $warehouseID = null;

    /**
     * @var string $locationID
     */
    protected $locationID = null;

    /**
     * @param string $warehouseID
     * @param string $locationID
     */
    public function __construct($warehouseID, $locationID)
    {
      $this->warehouseID = $warehouseID;
      $this->locationID = $locationID;
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
     * @return \Visual\InventoryService\LocationExists
     */
    public function setWarehouseID($warehouseID)
    {
      $this->warehouseID = $warehouseID;
      return $this;
    }

    /**
     * @return string
     */
    public function getLocationID()
    {
      return $this->locationID;
    }

    /**
     * @param string $locationID
     * @return \Visual\InventoryService\LocationExists
     */
    public function setLocationID($locationID)
    {
      $this->locationID = $locationID;
      return $this;
    }

}
