<?php

namespace Visual\CustomerService;

class GetDefaultCustomerShipViaCode2Response
{

    /**
     * @var string $GetDefaultCustomerShipViaCode2Result
     */
    protected $GetDefaultCustomerShipViaCode2Result = null;

    /**
     * @param string $GetDefaultCustomerShipViaCode2Result
     */
    public function __construct($GetDefaultCustomerShipViaCode2Result)
    {
      $this->GetDefaultCustomerShipViaCode2Result = $GetDefaultCustomerShipViaCode2Result;
    }

    /**
     * @return string
     */
    public function getGetDefaultCustomerShipViaCode2Result()
    {
      return $this->GetDefaultCustomerShipViaCode2Result;
    }

    /**
     * @param string $GetDefaultCustomerShipViaCode2Result
     * @return \Visual\CustomerService\GetDefaultCustomerShipViaCode2Response
     */
    public function setGetDefaultCustomerShipViaCode2Result($GetDefaultCustomerShipViaCode2Result)
    {
      $this->GetDefaultCustomerShipViaCode2Result = $GetDefaultCustomerShipViaCode2Result;
      return $this;
    }

}
