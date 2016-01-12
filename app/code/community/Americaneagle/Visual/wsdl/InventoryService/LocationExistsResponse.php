<?php

namespace Visual\InventoryService;

class LocationExistsResponse
{

    /**
     * @var boolean $LocationExistsResult
     */
    protected $LocationExistsResult = null;

    /**
     * @param boolean $LocationExistsResult
     */
    public function __construct($LocationExistsResult)
    {
      $this->LocationExistsResult = $LocationExistsResult;
    }

    /**
     * @return boolean
     */
    public function getLocationExistsResult()
    {
      return $this->LocationExistsResult;
    }

    /**
     * @param boolean $LocationExistsResult
     * @return \Visual\InventoryService\LocationExistsResponse
     */
    public function setLocationExistsResult($LocationExistsResult)
    {
      $this->LocationExistsResult = $LocationExistsResult;
      return $this;
    }

}
