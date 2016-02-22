<?php

namespace Visual\CustomerService;

class TestAvailableCreditResponse
{

    /**
     * @var float $TestAvailableCreditResult
     */
    protected $TestAvailableCreditResult = null;

    /**
     * @param float $TestAvailableCreditResult
     */
    public function __construct($TestAvailableCreditResult)
    {
      $this->TestAvailableCreditResult = $TestAvailableCreditResult;
    }

    /**
     * @return float
     */
    public function getTestAvailableCreditResult()
    {
      return $this->TestAvailableCreditResult;
    }

    /**
     * @param float $TestAvailableCreditResult
     * @return \Visual\CustomerService\TestAvailableCreditResponse
     */
    public function setTestAvailableCreditResult($TestAvailableCreditResult)
    {
      $this->TestAvailableCreditResult = $TestAvailableCreditResult;
      return $this;
    }

}
