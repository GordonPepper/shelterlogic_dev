<?php

namespace Visual\InventoryService;

class TestLookupUnitPriceResponse
{

    /**
     * @var string $TestLookupUnitPriceResult
     */
    protected $TestLookupUnitPriceResult = null;

    /**
     * @param string $TestLookupUnitPriceResult
     */
    public function __construct($TestLookupUnitPriceResult)
    {
      $this->TestLookupUnitPriceResult = $TestLookupUnitPriceResult;
    }

    /**
     * @return string
     */
    public function getTestLookupUnitPriceResult()
    {
      return $this->TestLookupUnitPriceResult;
    }

    /**
     * @param string $TestLookupUnitPriceResult
     * @return \Visual\InventoryService\TestLookupUnitPriceResponse
     */
    public function setTestLookupUnitPriceResult($TestLookupUnitPriceResult)
    {
      $this->TestLookupUnitPriceResult = $TestLookupUnitPriceResult;
      return $this;
    }

}
