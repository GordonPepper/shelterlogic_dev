<?php

namespace Visual\CustomerService;

class SearchAddressLikeResponse
{

    /**
     * @var AddressData $SearchAddressLikeResult
     */
    protected $SearchAddressLikeResult = null;

    /**
     * @param AddressData $SearchAddressLikeResult
     */
    public function __construct($SearchAddressLikeResult)
    {
      $this->SearchAddressLikeResult = $SearchAddressLikeResult;
    }

    /**
     * @return AddressData
     */
    public function getSearchAddressLikeResult()
    {
      return $this->SearchAddressLikeResult;
    }

    /**
     * @param AddressData $SearchAddressLikeResult
     * @return \Visual\CustomerService\SearchAddressLikeResponse
     */
    public function setSearchAddressLikeResult($SearchAddressLikeResult)
    {
      $this->SearchAddressLikeResult = $SearchAddressLikeResult;
      return $this;
    }

}
