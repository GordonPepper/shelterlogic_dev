<?php

namespace Visual\CustomerService;

class TestAvailableCredit
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
     * @var string $customerID
     */
    protected $customerID = null;

    /**
     * @var string $entityID
     */
    protected $entityID = null;

    /**
     * @param string $key
     * @param string $userName
     * @param string $password
     * @param string $customerID
     * @param string $entityID
     */
    public function __construct($key, $userName, $password, $customerID, $entityID)
    {
      $this->key = $key;
      $this->userName = $userName;
      $this->password = $password;
      $this->customerID = $customerID;
      $this->entityID = $entityID;
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
     * @return \Visual\CustomerService\TestAvailableCredit
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
     * @return \Visual\CustomerService\TestAvailableCredit
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
     * @return \Visual\CustomerService\TestAvailableCredit
     */
    public function setPassword($password)
    {
      $this->password = $password;
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
     * @return \Visual\CustomerService\TestAvailableCredit
     */
    public function setCustomerID($customerID)
    {
      $this->customerID = $customerID;
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
     * @return \Visual\CustomerService\TestAvailableCredit
     */
    public function setEntityID($entityID)
    {
      $this->entityID = $entityID;
      return $this;
    }

}
