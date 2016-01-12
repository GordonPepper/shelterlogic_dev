<?php

namespace Visual\CustomerService;

class GetDefaultCustomerShipViaCode
{

    /**
     * @var string $customerID
     */
    protected $customerID = null;

    /**
     * @param string $customerID
     */
    public function __construct($customerID)
    {
      $this->customerID = $customerID;
    }

    /**
     * @return string
     */
    public function getCustomerID()
    {
      return $this->customerID;
    }

    /**
     * @param string $customerID
     * @return \Visual\CustomerService\GetDefaultCustomerShipViaCode
     */
    public function setCustomerID($customerID)
    {
      $this->customerID = $customerID;
      return $this;
    }

}
