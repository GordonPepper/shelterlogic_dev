<?php

namespace Visual\InventoryService;

class PartPriceRequest
{

    /**
     * @var string $CustomerID
     */
    protected $CustomerID = null;

    /**
     * @var string $PartID
     */
    protected $PartID = null;

    /**
     * @var string $DiscountCode
     */
    protected $DiscountCode = null;

    /**
     * @var string $UM
     */
    protected $UM = null;

    /**
     * @var string $Market
     */
    protected $Market = null;

    /**
     * @var string $Currency
     */
    protected $Currency = null;

    /**
     * @var float $Qty
     */
    protected $Qty = null;

    /**
     * @var \DateTime $AsOfDate
     */
    protected $AsOfDate = null;

    /**
     * @var string $SiteID
     */
    protected $SiteID = null;

    /**
     * @param float $Qty
     */
    public function __construct($Qty)
    {
      $this->Qty = $Qty;
    }

    /**
     * @return string
     */
    public function getCustomerID()
    {
      return $this->CustomerID;
    }

    /**
     * @param string $CustomerID
     * @return \Visual\InventoryService\PartPriceRequest
     */
    public function setCustomerID($CustomerID)
    {
      $this->CustomerID = $CustomerID;
      return $this;
    }

    /**
     * @return string
     */
    public function getPartID()
    {
      return $this->PartID;
    }

    /**
     * @param string $PartID
     * @return \Visual\InventoryService\PartPriceRequest
     */
    public function setPartID($PartID)
    {
      $this->PartID = $PartID;
      return $this;
    }

    /**
     * @return string
     */
    public function getDiscountCode()
    {
      return $this->DiscountCode;
    }

    /**
     * @param string $DiscountCode
     * @return \Visual\InventoryService\PartPriceRequest
     */
    public function setDiscountCode($DiscountCode)
    {
      $this->DiscountCode = $DiscountCode;
      return $this;
    }

    /**
     * @return string
     */
    public function getUM()
    {
      return $this->UM;
    }

    /**
     * @param string $UM
     * @return \Visual\InventoryService\PartPriceRequest
     */
    public function setUM($UM)
    {
      $this->UM = $UM;
      return $this;
    }

    /**
     * @return string
     */
    public function getMarket()
    {
      return $this->Market;
    }

    /**
     * @param string $Market
     * @return \Visual\InventoryService\PartPriceRequest
     */
    public function setMarket($Market)
    {
      $this->Market = $Market;
      return $this;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
      return $this->Currency;
    }

    /**
     * @param string $Currency
     * @return \Visual\InventoryService\PartPriceRequest
     */
    public function setCurrency($Currency)
    {
      $this->Currency = $Currency;
      return $this;
    }

    /**
     * @return float
     */
    public function getQty()
    {
      return $this->Qty;
    }

    /**
     * @param float $Qty
     * @return \Visual\InventoryService\PartPriceRequest
     */
    public function setQty($Qty)
    {
      $this->Qty = $Qty;
      return $this;
    }

    /**
     * @return \DateTime
     */
    public function getAsOfDate()
    {
      if ($this->AsOfDate == null) {
        return null;
      } else {
        try {
          return new \DateTime($this->AsOfDate);
        } catch (\Exception $e) {
          return false;
        }
      }
    }

    /**
     * @param \DateTime $AsOfDate
     * @return \Visual\InventoryService\PartPriceRequest
     */
    public function setAsOfDate(\DateTime $AsOfDate = null)
    {
      if ($AsOfDate == null) {
       $this->AsOfDate = null;
      } else {
        $this->AsOfDate = $AsOfDate->format(\DateTime::ATOM);
      }
      return $this;
    }

    /**
     * @return string
     */
    public function getSiteID()
    {
      return $this->SiteID;
    }

    /**
     * @param string $SiteID
     * @return \Visual\InventoryService\PartPriceRequest
     */
    public function setSiteID($SiteID)
    {
      $this->SiteID = $SiteID;
      return $this;
    }

}
