<?php

namespace Visual\SalesOrderService;

class TestGetEmailAddressResponse
{

    /**
     * @var string $TestGetEmailAddressResult
     */
    protected $TestGetEmailAddressResult = null;

    /**
     * @param string $TestGetEmailAddressResult
     */
    public function __construct($TestGetEmailAddressResult)
    {
      $this->TestGetEmailAddressResult = $TestGetEmailAddressResult;
    }

    /**
     * @return string
     */
    public function getTestGetEmailAddressResult()
    {
      return $this->TestGetEmailAddressResult;
    }

    /**
     * @param string $TestGetEmailAddressResult
     * @return \Visual\SalesOrderService\TestGetEmailAddressResponse
     */
    public function setTestGetEmailAddressResult($TestGetEmailAddressResult)
    {
      $this->TestGetEmailAddressResult = $TestGetEmailAddressResult;
      return $this;
    }

}
