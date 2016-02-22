<?php

namespace Visual\SalesOrderService;

class SearchCustomerOrderLikeResponse
{

    /**
     * @var CustomerOrderData $SearchCustomerOrderLikeResult
     */
    protected $SearchCustomerOrderLikeResult = null;

    /**
     * @param CustomerOrderData $SearchCustomerOrderLikeResult
     */
    public function __construct($SearchCustomerOrderLikeResult)
    {
      $this->SearchCustomerOrderLikeResult = $SearchCustomerOrderLikeResult;
    }

    /**
     * @return CustomerOrderData
     */
    public function getSearchCustomerOrderLikeResult()
    {
      return $this->SearchCustomerOrderLikeResult;
    }

    /**
     * @param CustomerOrderData $SearchCustomerOrderLikeResult
     * @return \Visual\SalesOrderService\SearchCustomerOrderLikeResponse
     */
    public function setSearchCustomerOrderLikeResult($SearchCustomerOrderLikeResult)
    {
      $this->SearchCustomerOrderLikeResult = $SearchCustomerOrderLikeResult;
      return $this;
    }

}
