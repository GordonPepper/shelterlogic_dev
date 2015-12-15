<?php

namespace Visual\InventoryService;

class TestInventoryTransferResponse
{

    /**
     * @var string $TestInventoryTransferResult
     */
    protected $TestInventoryTransferResult = null;

    /**
     * @param string $TestInventoryTransferResult
     */
    public function __construct($TestInventoryTransferResult)
    {
      $this->TestInventoryTransferResult = $TestInventoryTransferResult;
    }

    /**
     * @return string
     */
    public function getTestInventoryTransferResult()
    {
      return $this->TestInventoryTransferResult;
    }

    /**
     * @param string $TestInventoryTransferResult
     * @return \Visual\InventoryService\TestInventoryTransferResponse
     */
    public function setTestInventoryTransferResult($TestInventoryTransferResult)
    {
      $this->TestInventoryTransferResult = $TestInventoryTransferResult;
      return $this;
    }

}
