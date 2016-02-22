<?php

namespace Visual\CustomerService;

class GetDefaultCustomerShipViaCode2
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
     * @param string $customerID
     * @param string $key
     * @param string $userName
     * @param string $password
     */
    public function __construct($customerID, $key, $userName, $password)
    {
      $this->customerID = $customerID;
      $this->key = $key;
      $this->userName = $userName;
      $this->password = $password;
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
     * @return \Visual\CustomerService\GetDefaultCustomerShipViaCode2
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
     * @return \Visual\CustomerService\GetDefaultCustomerShipViaCode2
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
     * @return \Visual\CustomerService\GetDefaultCustomerShipViaCode2
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
     * @return \Visual\CustomerService\GetDefaultCustomerShipViaCode2
     */
    public function setPassword($password)
    {
      $this->password = $password;
      return $this;
    }

}
