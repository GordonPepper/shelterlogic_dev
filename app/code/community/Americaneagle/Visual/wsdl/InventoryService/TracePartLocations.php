<?php

namespace Visual\InventoryService;

class TracePartLocations
{

    /**
     * @var string $partID
     */
    protected $partID = null;

    /**
     * @param string $partID
     */
    public function __construct($partID)
    {
      $this->partID = $partID;
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
     * @return \Visual\InventoryService\TracePartLocations
     */
    public function setPartID($partID)
    {
      $this->partID = $partID;
      return $this;
    }

}
