<?php

namespace Visual\InventoryService;

class PartLocationExists
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
     * @var string $partID
     */
    protected $partID = null;

    /**
     * @param string $warehouseID
     * @param string $locationID
     * @param string $partID
     */
    public function __construct($warehouseID, $locationID, $partID)
    {
      $this->warehouseID = $warehouseID;
      $this->locationID = $locationID;
      $this->partID = $partID;
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
     * @return \Visual\InventoryService\PartLocationExists
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
     * @return \Visual\InventoryService\PartLocationExists
     */
    public function setLocationID($locationID)
    {
      $this->locationID = $locationID;
      return $this;
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
     * @return \Visual\InventoryService\PartLocationExists
     */
    public function setPartID($partID)
    {
      $this->partID = $partID;
      return $this;
    }

}
