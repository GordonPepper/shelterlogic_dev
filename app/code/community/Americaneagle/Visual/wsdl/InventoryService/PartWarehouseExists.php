<?php

namespace Visual\InventoryService;

class PartWarehouseExists
{

    /**
     * @var string $warehouseID
     */
    protected $warehouseID = null;

    /**
     * @var string $partID
     */
    protected $partID = null;

    /**
     * @param string $warehouseID
     * @param string $partID
     */
    public function __construct($warehouseID, $partID)
    {
      $this->warehouseID = $warehouseID;
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
     * @return \Visual\InventoryService\PartWarehouseExists
     */
    public function setWarehouseID($warehouseID)
    {
      $this->warehouseID = $warehouseID;
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
     * @return \Visual\InventoryService\PartWarehouseExists
     */
    public function setPartID($partID)
    {
      $this->partID = $partID;
      return $this;
    }

}
