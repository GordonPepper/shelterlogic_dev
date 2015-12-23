<?php

namespace Visual\InventoryService;

class Part
{

    /**
     * @var string $ID
     */
    protected $ID = null;

    /**
     * @var string $Description
     */
    protected $Description = null;

    /**
     * @var float $UnitPrice
     */
    protected $UnitPrice = null;

    /**
     * @var float $ShippingWeight
     */
    protected $ShippingWeight = null;

    /**
     * @var string $ShippingUOM
     */
    protected $ShippingUOM = null;

    
    public function __construct()
    {
    
    }

    /**
     * @return string
     */
    public function getID()
    {
      return $this->ID;
    }

    /**
     * @param string $ID
     * @return \Visual\InventoryService\Part
     */
    public function setID($ID)
    {
      $this->ID = $ID;
      return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
      return $this->Description;
    }

    /**
     * @param string $Description
     * @return \Visual\InventoryService\Part
     */
    public function setDescription($Description)
    {
      $this->Description = $Description;
      return $this;
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
     * @return \Visual\InventoryService\Part
     */
    public function setUnitPrice($UnitPrice)
    {
      $this->UnitPrice = $UnitPrice;
      return $this;
    }

    /**
     * @return float
     */
    public function getShippingWeight()
    {
      return $this->ShippingWeight;
    }

    /**
     * @param float $ShippingWeight
     * @return \Visual\InventoryService\Part
     */
    public function setShippingWeight($ShippingWeight)
    {
      $this->ShippingWeight = $ShippingWeight;
      return $this;
    }

    /**
     * @return string
     */
    public function getShippingUOM()
    {
      return $this->ShippingUOM;
    }

    /**
     * @param string $ShippingUOM
     * @return \Visual\InventoryService\Part
     */
    public function setShippingUOM($ShippingUOM)
    {
      $this->ShippingUOM = $ShippingUOM;
      return $this;
    }

}
