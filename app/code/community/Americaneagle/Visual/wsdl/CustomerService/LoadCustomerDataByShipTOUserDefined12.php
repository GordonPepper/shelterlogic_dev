<?php

namespace Visual\CustomerService;

class LoadCustomerDataByShipTOUserDefined12
{

    /**
     * @var string $customerID
     */
    protected $customerID = null;

    /**
     * @var string $userDefined1
     */
    protected $userDefined1 = null;

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
     * @param string $userDefined1
     * @param string $key
     * @param string $userName
     * @param string $password
     */
    public function __construct($customerID, $userDefined1, $key, $userName, $password)
    {
      $this->customerID = $customerID;
      $this->userDefined1 = $userDefined1;
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
     * @return \Visual\CustomerService\LoadCustomerDataByShipTOUserDefined12
     */
    public function setCustomerID($customerID)
    {
      $this->customerID = $customerID;
      return $this;
    }

    /**
     * @return string
     */
    public function getUserDefined1()
    {
      return $this->userDefined1;
    }

    /**
     * @param string $userDefined1
     * @return \Visual\CustomerService\LoadCustomerDataByShipTOUserDefined12
     */
    public function setUserDefined1($userDefined1)
    {
      $this->userDefined1 = $userDefined1;
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
     * @return \Visual\CustomerService\LoadCustomerDataByShipTOUserDefined12
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
     * @return \Visual\CustomerService\LoadCustomerDataByShipTOUserDefined12
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
     * @return \Visual\CustomerService\LoadCustomerDataByShipTOUserDefined12
     */
    public function setPassword($password)
    {
      $this->password = $password;
      return $this;
    }

}
