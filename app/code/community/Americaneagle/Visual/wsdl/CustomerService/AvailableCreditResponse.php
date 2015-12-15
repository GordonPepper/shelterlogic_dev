<?php

namespace Visual\CustomerService;

class AvailableCreditResponse
{

    /**
     * @var float $AvailableCreditResult
     */
    protected $AvailableCreditResult = null;

    /**
     * @param float $AvailableCreditResult
     */
    public function __construct($AvailableCreditResult)
    {
      $this->AvailableCreditResult = $AvailableCreditResult;
    }

    /**
     * @return float
     */
    public function getAvailableCreditResult()
    {
      return $this->AvailableCreditResult;
    }

    /**
     * @param float $AvailableCreditResult
     * @return \Visual\CustomerService\AvailableCreditResponse
     */
    public function setAvailableCreditResult($AvailableCreditResult)
    {
      $this->AvailableCreditResult = $AvailableCreditResult;
      return $this;
    }

}
