<?php

namespace Visual\InventoryService;

class ProcessPhisicalInventoryTransaction2
{

    /**
     * @var InventoryCycleCountData $data
     */
    protected $data = null;

    /**
     * @var string $key
     */
    protected $key = null;

    /**
     * @param InventoryCycleCountData $data
     * @param string $key
     */
    public function __construct($data, $key)
    {
      $this->data = $data;
      $this->key = $key;
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
     * @return \Visual\InventoryService\ProcessPhisicalInventoryTransaction2
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
     * @return \Visual\InventoryService\ProcessPhisicalInventoryTransaction2
     */
    public function setKey($key)
    {
      $this->key = $key;
      return $this;
    }

}
