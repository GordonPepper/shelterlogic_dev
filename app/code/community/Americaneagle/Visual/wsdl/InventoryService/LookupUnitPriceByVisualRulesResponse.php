<?php

namespace Visual\InventoryService;

class LookupUnitPriceByVisualRulesResponse
{

    /**
     * @var PartPriceResponse $LookupUnitPriceByVisualRulesResult
     */
    protected $LookupUnitPriceByVisualRulesResult = null;

    /**
     * @param PartPriceResponse $LookupUnitPriceByVisualRulesResult
     */
    public function __construct($LookupUnitPriceByVisualRulesResult)
    {
      $this->LookupUnitPriceByVisualRulesResult = $LookupUnitPriceByVisualRulesResult;
    }

    /**
     * @return PartPriceResponse
     */
    public function getLookupUnitPriceByVisualRulesResult()
    {
      return $this->LookupUnitPriceByVisualRulesResult;
    }

    /**
     * @param PartPriceResponse $LookupUnitPriceByVisualRulesResult
     * @return \Visual\InventoryService\LookupUnitPriceByVisualRulesResponse
     */
    public function setLookupUnitPriceByVisualRulesResult($LookupUnitPriceByVisualRulesResult)
    {
      $this->LookupUnitPriceByVisualRulesResult = $LookupUnitPriceByVisualRulesResult;
      return $this;
    }

}
