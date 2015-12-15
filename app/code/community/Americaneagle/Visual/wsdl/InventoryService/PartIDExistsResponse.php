<?php

namespace Visual\InventoryService;

class PartIDExistsResponse
{

    /**
     * @var boolean $PartIDExistsResult
     */
    protected $PartIDExistsResult = null;

    /**
     * @param boolean $PartIDExistsResult
     */
    public function __construct($PartIDExistsResult)
    {
      $this->PartIDExistsResult = $PartIDExistsResult;
    }

    /**
     * @return boolean
     */
    public function getPartIDExistsResult()
    {
      return $this->PartIDExistsResult;
    }

    /**
     * @param boolean $PartIDExistsResult
     * @return \Visual\InventoryService\PartIDExistsResponse
     */
    public function setPartIDExistsResult($PartIDExistsResult)
    {
      $this->PartIDExistsResult = $PartIDExistsResult;
      return $this;
    }

}
