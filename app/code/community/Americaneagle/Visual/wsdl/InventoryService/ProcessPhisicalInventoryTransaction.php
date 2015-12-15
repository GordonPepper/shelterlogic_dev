<?php

namespace Visual\InventoryService;

class ProcessPhisicalInventoryTransaction
{

    /**
     * @var InventoryCycleCountData $data
     */
    protected $data = null;

    /**
     * @param InventoryCycleCountData $data
     */
    public function __construct($data)
    {
      $this->data = $data;
    }

    /**
     * @return InventoryCycleCountData
     */
    public function getData()
    {
      return $this->data;
    }

    /**
     * @param InventoryCycleCountData $data
     * @return \Visual\InventoryService\ProcessPhisicalInventoryTransaction
     */
    public function setData($data)
    {
      $this->data = $data;
      return $this;
    }

}
