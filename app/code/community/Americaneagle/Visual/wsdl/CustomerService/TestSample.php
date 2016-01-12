<?php

namespace Visual\CustomerService;

class TestSample
{

    /**
     * @var string $customerID
     */
    protected $customerID = null;

    /**
     * @var string $key
     */
    protected $key = null;

    /**
     * @var string $userName
     */
    protected $userName = null;

    /**
     * @var string $password
     */
    protected $password = null;

    /**
     * @var string $siteID
     */
    protected $siteID = null;

    /**
     * @var string $entityID
     */
    protected $entityID = null;

    /**
     * @var string $ExternalReferenceGroup
     */
    protected $ExternalReferenceGroup = null;

    /**
     * @param string $customerID
     * @param string $key
     * @param string $userName
     * @param string $password
     * @param string $siteID
     * @param string $entityID
     * @param string $ExternalReferenceGroup
     */
    public function __construct($customerID, $key, $userName, $password, $siteID, $entityID, $ExternalReferenceGroup)
    {
      $this->customerID = $customerID;
      $this->key = $key;
      $this->userName = $userName;
      $this->password = $password;
      $this->siteID = $siteID;
      $this->entityID = $entityID;
      $this->ExternalReferenceGroup = $ExternalReferenceGroup;
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
     * @return \Visual\CustomerService\TestSample
     */
    public function setCustomerID($customerID)
    {
      $this->customerID = $customerID;
      return $this;
    }

    /**
     * @return string
     */
    public function getKey()
    {
      return $this->key;
    }

    /**
     * @param string $key
     * @return \Visual\CustomerService\TestSample
     */
    public function setKey($key)
    {
      $this->key = $key;
      return $this;
    }

    /**
     * @return string
     */
    public function getUserName()
    {
      return $this->userName;
    }

    /**
     * @param string $userName
     * @return \Visual\CustomerService\TestSample
     */
    public function setUserName($userName)
    {
      $this->userName = $userName;
      return $this;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
      return $this->password;
    }

    /**
     * @param string $password
     * @return \Visual\CustomerService\TestSample
     */
    public function setPassword($password)
    {
      $this->password = $password;
      return $this;
    }

    /**
     * @return string
     */
    public function getSiteID()
    {
      return $this->siteID;
    }

    /**
     * @param string $siteID
     * @return \Visual\CustomerService\TestSample
     */
    public function setSiteID($siteID)
    {
      $this->siteID = $siteID;
      return $this;
    }

    /**
     * @return string
     */
    public function getEntityID()
    {
      return $this->entityID;
    }

    /**
     * @param string $entityID
     * @return \Visual\CustomerService\TestSample
     */
    public function setEntityID($entityID)
    {
      $this->entityID = $entityID;
      return $this;
    }

    /**
     * @return string
     */
    public function getExternalReferenceGroup()
    {
      return $this->ExternalReferenceGroup;
    }

    /**
     * @param string $ExternalReferenceGroup
     * @return \Visual\CustomerService\TestSample
     */
    public function setExternalReferenceGroup($ExternalReferenceGroup)
    {
      $this->ExternalReferenceGroup = $ExternalReferenceGroup;
      return $this;
    }

}
