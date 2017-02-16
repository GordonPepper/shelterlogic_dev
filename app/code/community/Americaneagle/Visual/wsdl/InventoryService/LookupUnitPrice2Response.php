<?php

namespace Visual\InventoryService;

class LookupUnitPrice2Response
{

    /**
     * @var PartPriceResponse $LookupUnitPrice2Result
     */
    protected $LookupUnitPrice2Result = null;

    /**
     * @param PartPriceResponse $LookupUnitPrice2Result
     */
    public function __construct($LookupUnitPrice2Result)
    {
      $this->LookupUnitPrice2Result = $LookupUnitPrice2Result;
    }

    /**
     * @return PartPriceResponse
     */
    public function getLookupUnitPrice2Result()
    {
      return $this->LookupUnitPrice2Result;
    }

    /**
     * @param PartPriceResponse $LookupUnitPrice2Result
     * @return \Visual\InventoryService\LookupUnitPrice2Response
     */
    public function setLookupUnitPrice2Result($LookupUnitPrice2Result)
    {
      $this->LookupUnitPrice2Result = $LookupUnitPrice2Result;
      return $this;
    }

}
