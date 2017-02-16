<?php

namespace Visual\CustomerService;

class AddNewAddress
{

    /**
     * @var string $customerID
     */
    protected $customerID = null;

    /**
     * @var CustomerAddress $caData
     */
    protected $caData = null;

    /**
     * @var string $siteFormat
     */
    protected $siteFormat = null;

    /**
     * @param string $customerID
     * @param CustomerAddress $caData
     * @param string $siteFormat
     */
    public function __construct($customerID, $caData, $siteFormat)
    {
      $this->customerID = $customerID;
      $this->caData = $caData;
      $this->siteFormat = $siteFormat;
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
     * @return \Visual\CustomerService\AddNewAddress
     */
    public function setCustomerID($customerID)
    {
      $this->customerID = $customerID;
      return $this;
    }

    /**
     * @return CustomerAddress
     */
    public function getCaData()
    {
      return $this->caData;
    }

    /**
     * @param CustomerAddress $caData
     * @return \Visual\CustomerService\AddNewAddress
     */
    public function setCaData($caData)
    {
      $this->caData = $caData;
      return $this;
    }

    /**
     * @return string
     */
    public function getSiteFormat()
    {
      return $this->siteFormat;
    }

    /**
     * @param string $siteFormat
     * @return \Visual\CustomerService\AddNewAddress
     */
    public function setSiteFormat($siteFormat)
    {
      $this->siteFormat = $siteFormat;
      return $this;
    }

}
