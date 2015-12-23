<?php

namespace Visual\InventoryService;

class GetMaterialCostResponse
{

    /**
     * @var float $GetMaterialCostResult
     */
    protected $GetMaterialCostResult = null;

    /**
     * @param float $GetMaterialCostResult
     */
    public function __construct($GetMaterialCostResult)
    {
      $this->GetMaterialCostResult = $GetMaterialCostResult;
    }

    /**
     * @return float
     */
    public function getGetMaterialCostResult()
    {
      return $this->GetMaterialCostResult;
    }

    /**
     * @param float $GetMaterialCostResult
     * @return \Visual\InventoryService\GetMaterialCostResponse
     */
    public function setGetMaterialCostResult($GetMaterialCostResult)
    {
      $this->GetMaterialCostResult = $GetMaterialCostResult;
      return $this;
    }

}
