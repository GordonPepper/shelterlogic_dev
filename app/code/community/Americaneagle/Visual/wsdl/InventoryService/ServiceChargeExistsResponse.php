<?php

namespace Visual\InventoryService;

class ServiceChargeExistsResponse
{

    /**
     * @var boolean $ServiceChargeExistsResult
     */
    protected $ServiceChargeExistsResult = null;

    /**
     * @param boolean $ServiceChargeExistsResult
     */
    public function __construct($ServiceChargeExistsResult)
    {
      $this->ServiceChargeExistsResult = $ServiceChargeExistsResult;
    }

    /**
     * @return boolean
     */
    public function getServiceChargeExistsResult()
    {
      return $this->ServiceChargeExistsResult;
    }

    /**
     * @param boolean $ServiceChargeExistsResult
     * @return \Visual\InventoryService\ServiceChargeExistsResponse
     */
    public function setServiceChargeExistsResult($ServiceChargeExistsResult)
    {
      $this->ServiceChargeExistsResult = $ServiceChargeExistsResult;
      return $this;
    }

}
