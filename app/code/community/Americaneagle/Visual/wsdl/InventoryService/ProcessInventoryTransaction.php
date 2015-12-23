<?php

namespace Visual\InventoryService;

class ProcessInventoryTransaction
{

    /**
     * @var InventoryTransactionData $data
     */
    protected $data = null;

    /**
     * @param InventoryTransactionData $data
     */
    public function __construct($data)
    {
      $this->data = $data;
    }

    /**
     * @return InventoryTransactionData
     */
    public function getData()
    {
      return $this->data;
    }

    /**
     * @param InventoryTransactionData $data
     * @return \Visual\InventoryService\ProcessInventoryTransaction
     */
    public function setData($data)
    {
      $this->data = $data;
      return $this;
    }

}
