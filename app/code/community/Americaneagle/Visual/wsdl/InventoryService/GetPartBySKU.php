<?php

namespace Visual\InventoryService;

class GetPartBySKU
{

    /**
     * @var string $sku
     */
    protected $sku = null;

    /**
     * @param string $sku
     */
    public function __construct($sku)
    {
      $this->sku = $sku;
    }

    /**
     * @return string
     */
    public function getSku()
    {
      return $this->sku;
    }

    /**
     * @param string $sku
     * @return \Visual\InventoryService\GetPartBySKU
     */
    public function setSku($sku)
    {
      $this->sku = $sku;
      return $this;
    }

}
