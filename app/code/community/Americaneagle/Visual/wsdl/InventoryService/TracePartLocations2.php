<?php

namespace Visual\InventoryService;

class TracePartLocations2
{

    /**
     * @var string $partID
     */
    protected $partID = null;

    /**
     * @var string $key
     */
    protected $key = null;

    /**
     * @param string $partID
     * @param string $key
     */
    public function __construct($partID, $key)
    {
      $this->partID = $partID;
      $this->key = $key;
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
     * @return \Visual\InventoryService\TracePartLocations2
     */
    public function setPartID($partID)
    {
      $this->partID = $partID;
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
     * @return \Visual\InventoryService\TracePartLocations2
     */
    public function setKey($key)
    {
      $this->key = $key;
      return $this;
    }

}
