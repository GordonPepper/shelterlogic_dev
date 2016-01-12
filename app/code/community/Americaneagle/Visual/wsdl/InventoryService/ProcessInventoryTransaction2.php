<?php

namespace Visual\InventoryService;

class ProcessInventoryTransaction2
{

    /**
     * @var InventoryTransactionData $data
     */
    protected $data = null;

    /**
     * @var string $key
     */
    protected $key = null;

    /**
     * @param InventoryTransactionData $data
     * @param string $key
     */
    public function __construct($data, $key)
    {
      $this->data = $data;
      $this->key = $key;
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
     * @return \Visual\InventoryService\ProcessInventoryTransaction2
     */
    public function setData($data)
    {
      $this->data = $data;
      return $this;
    }

    /**
     * @return string
     */
    public function getKey()
    {
      return $this->key;
    }

    /**
     * @param string $key
     * @return \Visual\InventoryService\ProcessInventoryTransaction2
     */
    public function setKey($key)
    {
      $this->key = $key;
      return $this;
    }

}
