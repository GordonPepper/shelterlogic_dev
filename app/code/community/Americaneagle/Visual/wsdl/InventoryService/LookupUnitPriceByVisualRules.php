<?php

namespace Visual\InventoryService;

class LookupUnitPriceByVisualRules
{

    /**
     * @var PartPriceRequest $req
     */
    protected $req = null;

    /**
     * @param PartPriceRequest $req
     */
    public function __construct($req)
    {
      $this->req = $req;
    }

    /**
     * @return PartPriceRequest
     */
    public function getReq()
    {
      return $this->req;
    }

    /**
     * @param PartPriceRequest $req
     * @return \Visual\InventoryService\LookupUnitPriceByVisualRules
     */
    public function setReq($req)
    {
      $this->req = $req;
      return $this;
    }

}
