<?php

namespace Visual\InventoryService;

class LookupUnitPriceResponse
{

    /**
     * @var PartPriceResponse $LookupUnitPriceResult
     */
    protected $LookupUnitPriceResult = null;

    /**
     * @param PartPriceResponse $LookupUnitPriceResult
     */
    public function __construct($LookupUnitPriceResult)
    {
      $this->LookupUnitPriceResult = $LookupUnitPriceResult;
    }

    /**
     * @return PartPriceResponse
     */
    public function getLookupUnitPriceResult()
    {
      return $this->LookupUnitPriceResult;
    }

    /**
     * @param PartPriceResponse $LookupUnitPriceResult
     * @return \Visual\InventoryService\LookupUnitPriceResponse
     */
    public function setLookupUnitPriceResult($LookupUnitPriceResult)
    {
      $this->LookupUnitPriceResult = $LookupUnitPriceResult;
      return $this;
    }

}
