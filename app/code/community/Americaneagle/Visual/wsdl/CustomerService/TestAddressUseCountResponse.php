<?php

namespace Visual\CustomerService;

class TestAddressUseCountResponse
{

    /**
     * @var int $TestAddressUseCountResult
     */
    protected $TestAddressUseCountResult = null;

    /**
     * @param int $TestAddressUseCountResult
     */
    public function __construct($TestAddressUseCountResult)
    {
      $this->TestAddressUseCountResult = $TestAddressUseCountResult;
    }

    /**
     * @return int
     */
    public function getTestAddressUseCountResult()
    {
      return $this->TestAddressUseCountResult;
    }

    /**
     * @param int $TestAddressUseCountResult
     * @return \Visual\CustomerService\TestAddressUseCountResponse
     */
    public function setTestAddressUseCountResult($TestAddressUseCountResult)
    {
      $this->TestAddressUseCountResult = $TestAddressUseCountResult;
      return $this;
    }

}
