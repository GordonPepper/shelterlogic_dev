<?php

namespace Visual\CustomerService;

class SearchCustomerResponse
{

    /**
     * @var CustomerData $SearchCustomerResult
     */
    protected $SearchCustomerResult = null;

    /**
     * @param CustomerData $SearchCustomerResult
     */
    public function __construct($SearchCustomerResult)
    {
      $this->SearchCustomerResult = $SearchCustomerResult;
    }

    /**
     * @return CustomerData
     */
    public function getSearchCustomerResult()
    {
      return $this->SearchCustomerResult;
    }

    /**
     * @param CustomerData $SearchCustomerResult
     * @return \Visual\CustomerService\SearchCustomerResponse
     */
    public function setSearchCustomerResult($SearchCustomerResult)
    {
      $this->SearchCustomerResult = $SearchCustomerResult;
      return $this;
    }

}
