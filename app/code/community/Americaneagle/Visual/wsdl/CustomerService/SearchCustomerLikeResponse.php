<?php

namespace Visual\CustomerService;

class SearchCustomerLikeResponse
{

    /**
     * @var CustomerData $SearchCustomerLikeResult
     */
    protected $SearchCustomerLikeResult = null;

    /**
     * @param CustomerData $SearchCustomerLikeResult
     */
    public function __construct($SearchCustomerLikeResult)
    {
      $this->SearchCustomerLikeResult = $SearchCustomerLikeResult;
    }

    /**
     * @return CustomerData
     */
    public function getSearchCustomerLikeResult()
    {
      return $this->SearchCustomerLikeResult;
    }

    /**
     * @param CustomerData $SearchCustomerLikeResult
     * @return \Visual\CustomerService\SearchCustomerLikeResponse
     */
    public function setSearchCustomerLikeResult($SearchCustomerLikeResult)
    {
      $this->SearchCustomerLikeResult = $SearchCustomerLikeResult;
      return $this;
    }

}
