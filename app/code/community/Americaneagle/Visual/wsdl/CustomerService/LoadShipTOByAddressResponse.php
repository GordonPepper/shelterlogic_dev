<?php

namespace Visual\CustomerService;

class LoadShipTOByAddressResponse
{

    /**
     * @var string $LoadShipTOByAddressResult
     */
    protected $LoadShipTOByAddressResult = null;

    /**
     * @param string $LoadShipTOByAddressResult
     */
    public function __construct($LoadShipTOByAddressResult)
    {
      $this->LoadShipTOByAddressResult = $LoadShipTOByAddressResult;
    }

    /**
     * @return string
     */
    public function getLoadShipTOByAddressResult()
    {
      return $this->LoadShipTOByAddressResult;
    }

    /**
     * @param string $LoadShipTOByAddressResult
     * @return \Visual\CustomerService\LoadShipTOByAddressResponse
     */
    public function setLoadShipTOByAddressResult($LoadShipTOByAddressResult)
    {
      $this->LoadShipTOByAddressResult = $LoadShipTOByAddressResult;
      return $this;
    }

}
