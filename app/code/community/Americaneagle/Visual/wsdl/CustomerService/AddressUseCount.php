<?php

namespace Visual\CustomerService;

class AddressUseCount
{

    /**
     * @var string $customerID
     */
    protected $customerID = null;

    /**
     * @var string $shipToID
     */
    protected $shipToID = null;

    /**
     * @param string $customerID
     * @param string $shipToID
     */
    public function __construct($customerID, $shipToID)
    {
      $this->customerID = $customerID;
      $this->shipToID = $shipToID;
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
     * @return \Visual\CustomerService\AddressUseCount
     */
    public function setCustomerID($customerID)
    {
      $this->customerID = $customerID;
      return $this;
    }

    /**
     * @return string
     */
    public function getShipToID()
    {
      return $this->shipToID;
    }

    /**
     * @param string $shipToID
     * @return \Visual\CustomerService\AddressUseCount
     */
    public function setShipToID($shipToID)
    {
      $this->shipToID = $shipToID;
      return $this;
    }

}
