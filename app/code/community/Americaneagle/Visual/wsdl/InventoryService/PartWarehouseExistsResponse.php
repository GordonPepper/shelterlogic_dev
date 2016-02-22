<?php

namespace Visual\InventoryService;

class PartWarehouseExistsResponse
{

    /**
     * @var boolean $PartWarehouseExistsResult
     */
    protected $PartWarehouseExistsResult = null;

    /**
     * @param boolean $PartWarehouseExistsResult
     */
    public function __construct($PartWarehouseExistsResult)
    {
      $this->PartWarehouseExistsResult = $PartWarehouseExistsResult;
    }

    /**
     * @return boolean
     */
    public function getPartWarehouseExistsResult()
    {
      return $this->PartWarehouseExistsResult;
    }

    /**
     * @param boolean $PartWarehouseExistsResult
     * @return \Visual\InventoryService\PartWarehouseExistsResponse
     */
    public function setPartWarehouseExistsResult($PartWarehouseExistsResult)
    {
      $this->PartWarehouseExistsResult = $PartWarehouseExistsResult;
      return $this;
    }

}
