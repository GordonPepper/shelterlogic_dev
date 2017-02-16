<?php

namespace Visual\InventoryService;

class PartPriceResponse
{

    /**
     * @var float $UnitPrice
     */
    protected $UnitPrice = null;

    /**
     * @var float $TradeDiscountPercent
     */
    protected $TradeDiscountPercent = null;

    /**
     * @var PartPriceRequest $Request
     */
    protected $Request = null;

    /**
     * @param float $UnitPrice
     * @param float $TradeDiscountPercent
     */
    public function __construct($UnitPrice, $TradeDiscountPercent)
    {
      $this->UnitPrice = $UnitPrice;
      $this->TradeDiscountPercent = $TradeDiscountPercent;
    }

    /**
     * @return float
     */
    public function getUnitPrice()
    {
      return $this->UnitPrice;
    }

    /**
     * @param float $UnitPrice
     * @return \Visual\InventoryService\PartPriceResponse
     */
    public function setUnitPrice($UnitPrice)
    {
      $this->UnitPrice = $UnitPrice;
      return $this;
    }

    /**
     * @return float
     */
    public function getTradeDiscountPercent()
    {
      return $this->TradeDiscountPercent;
    }

    /**
     * @param float $TradeDiscountPercent
     * @return \Visual\InventoryService\PartPriceResponse
     */
    public function setTradeDiscountPercent($TradeDiscountPercent)
    {
      $this->TradeDiscountPercent = $TradeDiscountPercent;
      return $this;
    }

    /**
     * @return PartPriceRequest
     */
    public function getRequest()
    {
      return $this->Request;
    }

    /**
     * @param PartPriceRequest $Request
     * @return \Visual\InventoryService\PartPriceResponse
     */
    public function setRequest($Request)
    {
      $this->Request = $Request;
      return $this;
    }

}
