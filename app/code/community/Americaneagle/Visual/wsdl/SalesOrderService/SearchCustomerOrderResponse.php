<?php

namespace Visual\SalesOrderService;

class SearchCustomerOrderResponse
{

    /**
     * @var CustomerOrderData $SearchCustomerOrderResult
     */
    protected $SearchCustomerOrderResult = null;

    /**
     * @param CustomerOrderData $SearchCustomerOrderResult
     */
    public function __construct($SearchCustomerOrderResult)
    {
      $this->SearchCustomerOrderResult = $SearchCustomerOrderResult;
    }

    /**
     * @return CustomerOrderData
     */
    public function getSearchCustomerOrderResult()
    {
      return $this->SearchCustomerOrderResult;
    }

    /**
     * @param CustomerOrderData $SearchCustomerOrderResult
     * @return \Visual\SalesOrderService\SearchCustomerOrderResponse
     */
    public function setSearchCustomerOrderResult($SearchCustomerOrderResult)
    {
      $this->SearchCustomerOrderResult = $SearchCustomerOrderResult;
      return $this;
    }

}
