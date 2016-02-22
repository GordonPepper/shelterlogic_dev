<?php

namespace Visual\CustomerService;

class GetShipViaCodes2Response
{

    /**
     * @var ArrayOfString $GetShipViaCodes2Result
     */
    protected $GetShipViaCodes2Result = null;

    /**
     * @param ArrayOfString $GetShipViaCodes2Result
     */
    public function __construct($GetShipViaCodes2Result)
    {
      $this->GetShipViaCodes2Result = $GetShipViaCodes2Result;
    }

    /**
     * @return ArrayOfString
     */
    public function getGetShipViaCodes2Result()
    {
      return $this->GetShipViaCodes2Result;
    }

    /**
     * @param ArrayOfString $GetShipViaCodes2Result
     * @return \Visual\CustomerService\GetShipViaCodes2Response
     */
    public function setGetShipViaCodes2Result($GetShipViaCodes2Result)
    {
      $this->GetShipViaCodes2Result = $GetShipViaCodes2Result;
      return $this;
    }

}
