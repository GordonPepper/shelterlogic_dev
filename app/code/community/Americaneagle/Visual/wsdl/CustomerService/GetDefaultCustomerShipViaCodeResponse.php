<?php

namespace Visual\CustomerService;

class GetDefaultCustomerShipViaCodeResponse
{

    /**
     * @var string $GetDefaultCustomerShipViaCodeResult
     */
    protected $GetDefaultCustomerShipViaCodeResult = null;

    /**
     * @param string $GetDefaultCustomerShipViaCodeResult
     */
    public function __construct($GetDefaultCustomerShipViaCodeResult)
    {
      $this->GetDefaultCustomerShipViaCodeResult = $GetDefaultCustomerShipViaCodeResult;
    }

    /**
     * @return string
     */
    public function getGetDefaultCustomerShipViaCodeResult()
    {
      return $this->GetDefaultCustomerShipViaCodeResult;
    }

    /**
     * @param string $GetDefaultCustomerShipViaCodeResult
     * @return \Visual\CustomerService\GetDefaultCustomerShipViaCodeResponse
     */
    public function setGetDefaultCustomerShipViaCodeResult($GetDefaultCustomerShipViaCodeResult)
    {
      $this->GetDefaultCustomerShipViaCodeResult = $GetDefaultCustomerShipViaCodeResult;
      return $this;
    }

}
