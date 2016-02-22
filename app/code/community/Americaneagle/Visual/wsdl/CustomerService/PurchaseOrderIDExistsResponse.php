<?php

namespace Visual\CustomerService;

class PurchaseOrderIDExistsResponse
{

    /**
     * @var boolean $PurchaseOrderIDExistsResult
     */
    protected $PurchaseOrderIDExistsResult = null;

    /**
     * @param boolean $PurchaseOrderIDExistsResult
     */
    public function __construct($PurchaseOrderIDExistsResult)
    {
      $this->PurchaseOrderIDExistsResult = $PurchaseOrderIDExistsResult;
    }

    /**
     * @return boolean
     */
    public function getPurchaseOrderIDExistsResult()
    {
      return $this->PurchaseOrderIDExistsResult;
    }

    /**
     * @param boolean $PurchaseOrderIDExistsResult
     * @return \Visual\CustomerService\PurchaseOrderIDExistsResponse
     */
    public function setPurchaseOrderIDExistsResult($PurchaseOrderIDExistsResult)
    {
      $this->PurchaseOrderIDExistsResult = $PurchaseOrderIDExistsResult;
      return $this;
    }

}
