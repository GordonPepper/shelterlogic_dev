<?php

namespace Visual\CustomerService;

class PurchaseOrderIDExists2Response
{

    /**
     * @var boolean $PurchaseOrderIDExists2Result
     */
    protected $PurchaseOrderIDExists2Result = null;

    /**
     * @param boolean $PurchaseOrderIDExists2Result
     */
    public function __construct($PurchaseOrderIDExists2Result)
    {
      $this->PurchaseOrderIDExists2Result = $PurchaseOrderIDExists2Result;
    }

    /**
     * @return boolean
     */
    public function getPurchaseOrderIDExists2Result()
    {
      return $this->PurchaseOrderIDExists2Result;
    }

    /**
     * @param boolean $PurchaseOrderIDExists2Result
     * @return \Visual\CustomerService\PurchaseOrderIDExists2Response
     */
    public function setPurchaseOrderIDExists2Result($PurchaseOrderIDExists2Result)
    {
      $this->PurchaseOrderIDExists2Result = $PurchaseOrderIDExists2Result;
      return $this;
    }

}
