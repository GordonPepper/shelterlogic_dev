<?php

namespace Visual\CustomerService;

class TestSearchAdderessResponse
{

    /**
     * @var AddressData $TestSearchAdderessResult
     */
    protected $TestSearchAdderessResult = null;

    /**
     * @param AddressData $TestSearchAdderessResult
     */
    public function __construct($TestSearchAdderessResult)
    {
      $this->TestSearchAdderessResult = $TestSearchAdderessResult;
    }

    /**
     * @return AddressData
     */
    public function getTestSearchAdderessResult()
    {
      return $this->TestSearchAdderessResult;
    }

    /**
     * @param AddressData $TestSearchAdderessResult
     * @return \Visual\CustomerService\TestSearchAdderessResponse
     */
    public function setTestSearchAdderessResult($TestSearchAdderessResult)
    {
      $this->TestSearchAdderessResult = $TestSearchAdderessResult;
      return $this;
    }

}
