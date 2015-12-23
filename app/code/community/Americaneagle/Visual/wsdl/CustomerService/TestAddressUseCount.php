<?php

namespace Visual\CustomerService;

class TestAddressUseCount
{

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
     * @var string $externalRefGroup
     */
    protected $externalRefGroup = null;

    /**
     * @var string $customerID
     */
    protected $customerID = null;

    /**
     * @var string $shipToID
     */
    protected $shipToID = null;

    /**
     * @param string $key
     * @param string $userName
     * @param string $password
     * @param string $externalRefGroup
     * @param string $customerID
     * @param string $shipToID
     */
    public function __construct($key, $userName, $password, $externalRefGroup, $customerID, $shipToID)
    {
      $this->key = $key;
      $this->userName = $userName;
      $this->password = $password;
      $this->externalRefGroup = $externalRefGroup;
      $this->customerID = $customerID;
      $this->shipToID = $shipToID;
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
     * @return \Visual\CustomerService\TestAddressUseCount
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
     * @return \Visual\CustomerService\TestAddressUseCount
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
     * @return \Visual\CustomerService\TestAddressUseCount
     */
    public function setPassword($password)
    {
      $this->password = $password;
      return $this;
    }

    /**
     * @return string
     */
    public function getExternalRefGroup()
    {
      return $this->externalRefGroup;
    }

    /**
     * @param string $externalRefGroup
     * @return \Visual\CustomerService\TestAddressUseCount
     */
    public function setExternalRefGroup($externalRefGroup)
    {
      $this->externalRefGroup = $externalRefGroup;
      return $this;
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
     * @return \Visual\CustomerService\TestAddressUseCount
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
     * @return \Visual\CustomerService\TestAddressUseCount
     */
    public function setShipToID($shipToID)
    {
      $this->shipToID = $shipToID;
      return $this;
    }

}
