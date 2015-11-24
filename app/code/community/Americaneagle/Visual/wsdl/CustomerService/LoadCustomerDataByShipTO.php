<?php

namespace Visual\CustomerService;

class LoadCustomerDataByShipTO
{

    /**
     * @var string $customerID
     */
    protected $customerID = null;

    /**
     * @var string $shipTOID
     */
    protected $shipTOID = null;

    /**
     * @param string $customerID
     * @param string $shipTOID
     */
    public function __construct($customerID, $shipTOID)
    {
      $this->customerID = $customerID;
      $this->shipTOID = $shipTOID;
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
     * @return \Visual\CustomerService\LoadCustomerDataByShipTO
     */
    public function setCustomerID($customerID)
    {
      $this->customerID = $customerID;
      return $this;
    }

    /**
     * @return string
     */
    public function getShipTOID()
    {
      return $this->shipTOID;
    }

    /**
     * @param string $shipTOID
     * @return \Visual\CustomerService\LoadCustomerDataByShipTO
     */
    public function setShipTOID($shipTOID)
    {
      $this->shipTOID = $shipTOID;
      return $this;
    }

}
