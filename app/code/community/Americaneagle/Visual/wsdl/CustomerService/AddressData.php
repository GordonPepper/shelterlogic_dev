<?php

namespace Visual\CustomerService;

class AddressData
{

    /**
     * @var string $CustomerID
     */
    protected $CustomerID = null;

    /**
     * @var ArrayOfCustomerAddress $Addresses
     */
    protected $Addresses = null;

    
    public function __construct()
    {
    
    }

    /**
     * @return string
     */
    public function getCustomerID()
    {
      return $this->CustomerID;
    }

    /**
     * @param string $CustomerID
     * @return \Visual\CustomerService\AddressData
     */
    public function setCustomerID($CustomerID)
    {
      $this->CustomerID = $CustomerID;
      return $this;
    }

    /**
     * @return ArrayOfCustomerAddress
     */
    public function getAddresses()
    {
      return $this->Addresses;
    }

    /**
     * @param ArrayOfCustomerAddress $Addresses
     * @return \Visual\CustomerService\AddressData
     */
    public function setAddresses($Addresses)
    {
      $this->Addresses = $Addresses;
      return $this;
    }

}
