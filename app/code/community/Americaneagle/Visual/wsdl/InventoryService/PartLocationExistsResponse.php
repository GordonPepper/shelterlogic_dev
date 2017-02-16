<?php

namespace Visual\InventoryService;

class PartLocationExistsResponse
{

    /**
     * @var boolean $PartLocationExistsResult
     */
    protected $PartLocationExistsResult = null;

    /**
     * @param boolean $PartLocationExistsResult
     */
    public function __construct($PartLocationExistsResult)
    {
      $this->PartLocationExistsResult = $PartLocationExistsResult;
    }

    /**
     * @return boolean
     */
    public function getPartLocationExistsResult()
    {
      return $this->PartLocationExistsResult;
    }

    /**
     * @param boolean $PartLocationExistsResult
     * @return \Visual\InventoryService\PartLocationExistsResponse
     */
    public function setPartLocationExistsResult($PartLocationExistsResult)
    {
      $this->PartLocationExistsResult = $PartLocationExistsResult;
      return $this;
    }

}
