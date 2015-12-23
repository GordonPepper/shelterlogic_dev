<?php

namespace Visual\InventoryService;

class TraceLocation
{

    /**
     * @var string $PartID
     */
    protected $PartID = null;

    /**
     * @var string $TraceID
     */
    protected $TraceID = null;

    /**
     * @var string $WarehouseID
     */
    protected $WarehouseID = null;

    /**
     * @var string $LocationID
     */
    protected $LocationID = null;

    /**
     * @var float $Quantity
     */
    protected $Quantity = null;

    /**
     * @param float $Quantity
     */
    public function __construct($Quantity)
    {
      $this->Quantity = $Quantity;
    }

    /**
     * @return string
     */
    public function getPartID()
    {
      return $this->PartID;
    }

    /**
     * @param string $PartID
     * @return \Visual\InventoryService\TraceLocation
     */
    public function setPartID($PartID)
    {
      $this->PartID = $PartID;
      return $this;
    }

    /**
     * @return string
     */
    public function getTraceID()
    {
      return $this->TraceID;
    }

    /**
     * @param string $TraceID
     * @return \Visual\InventoryService\TraceLocation
     */
    public function setTraceID($TraceID)
    {
      $this->TraceID = $TraceID;
      return $this;
    }

    /**
     * @return string
     */
    public function getWarehouseID()
    {
      return $this->WarehouseID;
    }

    /**
     * @param string $WarehouseID
     * @return \Visual\InventoryService\TraceLocation
     */
    public function setWarehouseID($WarehouseID)
    {
      $this->WarehouseID = $WarehouseID;
      return $this;
    }

    /**
     * @return string
     */
    public function getLocationID()
    {
      return $this->LocationID;
    }

    /**
     * @param string $LocationID
     * @return \Visual\InventoryService\TraceLocation
     */
    public function setLocationID($LocationID)
    {
      $this->LocationID = $LocationID;
      return $this;
    }

    /**
     * @return float
     */
    public function getQuantity()
    {
      return $this->Quantity;
    }

    /**
     * @param float $Quantity
     * @return \Visual\InventoryService\TraceLocation
     */
    public function setQuantity($Quantity)
    {
      $this->Quantity = $Quantity;
      return $this;
    }

}
