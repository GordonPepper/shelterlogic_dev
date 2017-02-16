<?php

namespace Visual\InventoryService;

class GetInventoryPositionResponse
{

    /**
     * @var float $GetInventoryPositionResult
     */
    protected $GetInventoryPositionResult = null;

    /**
     * @param float $GetInventoryPositionResult
     */
    public function __construct($GetInventoryPositionResult)
    {
      $this->GetInventoryPositionResult = $GetInventoryPositionResult;
    }

    /**
     * @return float
     */
    public function getGetInventoryPositionResult()
    {
      return $this->GetInventoryPositionResult;
    }

    /**
     * @param float $GetInventoryPositionResult
     * @return \Visual\InventoryService\GetInventoryPositionResponse
     */
    public function setGetInventoryPositionResult($GetInventoryPositionResult)
    {
      $this->GetInventoryPositionResult = $GetInventoryPositionResult;
      return $this;
    }

}
