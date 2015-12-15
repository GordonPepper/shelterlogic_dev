<?php

namespace Visual\CustomerService;

class AddressUseCountResponse
{

    /**
     * @var int $AddressUseCountResult
     */
    protected $AddressUseCountResult = null;

    /**
     * @param int $AddressUseCountResult
     */
    public function __construct($AddressUseCountResult)
    {
      $this->AddressUseCountResult = $AddressUseCountResult;
    }

    /**
     * @return int
     */
    public function getAddressUseCountResult()
    {
      return $this->AddressUseCountResult;
    }

    /**
     * @param int $AddressUseCountResult
     * @return \Visual\CustomerService\AddressUseCountResponse
     */
    public function setAddressUseCountResult($AddressUseCountResult)
    {
      $this->AddressUseCountResult = $AddressUseCountResult;
      return $this;
    }

}
