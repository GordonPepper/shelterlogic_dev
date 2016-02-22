<?php

namespace Visual\CustomerService;

class SearchAddressResponse
{

    /**
     * @var AddressData $SearchAddressResult
     */
    protected $SearchAddressResult = null;

    /**
     * @param AddressData $SearchAddressResult
     */
    public function __construct($SearchAddressResult)
    {
      $this->SearchAddressResult = $SearchAddressResult;
    }

    /**
     * @return AddressData
     */
    public function getSearchAddressResult()
    {
      return $this->SearchAddressResult;
    }

    /**
     * @param AddressData $SearchAddressResult
     * @return \Visual\CustomerService\SearchAddressResponse
     */
    public function setSearchAddressResult($SearchAddressResult)
    {
      $this->SearchAddressResult = $SearchAddressResult;
      return $this;
    }

}
