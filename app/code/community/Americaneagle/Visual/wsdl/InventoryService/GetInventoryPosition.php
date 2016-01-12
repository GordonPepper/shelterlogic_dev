<?php

namespace Visual\InventoryService;

class GetInventoryPosition
{

    /**
     * @var string $partID
     */
    protected $partID = null;

    /**
     * @var string $warehouseID
     */
    protected $warehouseID = null;

    /**
     * @var string $locationID
     */
    protected $locationID = null;

    /**
     * @param string $partID
     * @param string $warehouseID
     * @param string $locationID
     */
    public function __construct($partID, $warehouseID, $locationID)
    {
      $this->partID = $partID;
      $this->warehouseID = $warehouseID;
      $this->locationID = $locationID;
    }

    /**
     * @return string
     */
    public function getPartID()
    {
      return $this->partID;
    }

    /**
     * @param string $partID
     * @return \Visual\InventoryService\GetInventoryPosition
     */
    public function setPartID($partID)
    {
      $this->partID = $partID;
      return $this;
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
     * @return \Visual\InventoryService\GetInventoryPosition
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
     * @return \Visual\InventoryService\GetInventoryPosition
     */
    public function setLocationID($locationID)
    {
      $this->locationID = $locationID;
      return $this;
    }

}
