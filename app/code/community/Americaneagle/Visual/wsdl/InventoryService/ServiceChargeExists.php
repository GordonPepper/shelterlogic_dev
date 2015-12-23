<?php

namespace Visual\InventoryService;

class ServiceChargeExists
{

    /**
     * @var string $serviceChargeID
     */
    protected $serviceChargeID = null;

    /**
     * @param string $serviceChargeID
     */
    public function __construct($serviceChargeID)
    {
      $this->serviceChargeID = $serviceChargeID;
    }

    /**
     * @return string
     */
    public function getServiceChargeID()
    {
      return $this->serviceChargeID;
    }

    /**
     * @param string $serviceChargeID
     * @return \Visual\InventoryService\ServiceChargeExists
     */
    public function setServiceChargeID($serviceChargeID)
    {
      $this->serviceChargeID = $serviceChargeID;
      return $this;
    }

}
