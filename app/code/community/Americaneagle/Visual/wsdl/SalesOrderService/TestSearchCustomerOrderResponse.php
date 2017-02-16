<?php

namespace Visual\SalesOrderService;

class TestSearchCustomerOrderResponse
{

    /**
     * @var CustomerOrderData $TestSearchCustomerOrderResult
     */
    protected $TestSearchCustomerOrderResult = null;

    /**
     * @param CustomerOrderData $TestSearchCustomerOrderResult
     */
    public function __construct($TestSearchCustomerOrderResult)
    {
      $this->TestSearchCustomerOrderResult = $TestSearchCustomerOrderResult;
    }

    /**
     * @return CustomerOrderData
     */
    public function getTestSearchCustomerOrderResult()
    {
      return $this->TestSearchCustomerOrderResult;
    }

    /**
     * @param CustomerOrderData $TestSearchCustomerOrderResult
     * @return \Visual\SalesOrderService\TestSearchCustomerOrderResponse
     */
    public function setTestSearchCustomerOrderResult($TestSearchCustomerOrderResult)
    {
      $this->TestSearchCustomerOrderResult = $TestSearchCustomerOrderResult;
      return $this;
    }

}
