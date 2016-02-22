<?php

namespace Visual\InventoryService;

class WarehouseExistsResponse
{

    /**
     * @var boolean $WarehouseExistsResult
     */
    protected $WarehouseExistsResult = null;

    /**
     * @param boolean $WarehouseExistsResult
     */
    public function __construct($WarehouseExistsResult)
    {
      $this->WarehouseExistsResult = $WarehouseExistsResult;
    }

    /**
     * @return boolean
     */
    public function getWarehouseExistsResult()
    {
      return $this->WarehouseExistsResult;
    }

    /**
     * @param boolean $WarehouseExistsResult
     * @return \Visual\InventoryService\WarehouseExistsResponse
     */
    public function setWarehouseExistsResult($WarehouseExistsResult)
    {
      $this->WarehouseExistsResult = $WarehouseExistsResult;
      return $this;
    }

}
