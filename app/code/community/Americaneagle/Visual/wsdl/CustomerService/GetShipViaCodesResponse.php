<?php

namespace Visual\CustomerService;

class GetShipViaCodesResponse
{

    /**
     * @var ArrayOfString $GetShipViaCodesResult
     */
    protected $GetShipViaCodesResult = null;

    /**
     * @param ArrayOfString $GetShipViaCodesResult
     */
    public function __construct($GetShipViaCodesResult)
    {
      $this->GetShipViaCodesResult = $GetShipViaCodesResult;
    }

    /**
     * @return ArrayOfString
     */
    public function getGetShipViaCodesResult()
    {
      return $this->GetShipViaCodesResult;
    }

    /**
     * @param ArrayOfString $GetShipViaCodesResult
     * @return \Visual\CustomerService\GetShipViaCodesResponse
     */
    public function setGetShipViaCodesResult($GetShipViaCodesResult)
    {
      $this->GetShipViaCodesResult = $GetShipViaCodesResult;
      return $this;
    }

}
