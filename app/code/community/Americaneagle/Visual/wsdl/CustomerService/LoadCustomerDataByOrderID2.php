<?php

namespace Visual\CustomerService;

class LoadCustomerDataByOrderID2
{

    /**
     * @var string $cusOrderID
     */
    protected $cusOrderID = null;

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
     * @var string $externalReferenceGroup
     */
    protected $externalReferenceGroup = null;

    /**
     * @param string $cusOrderID
     * @param string $key
     * @param string $userName
     * @param string $password
     * @param string $externalReferenceGroup
     */
    public function __construct($cusOrderID, $key, $userName, $password, $externalReferenceGroup)
    {
      $this->cusOrderID = $cusOrderID;
      $this->key = $key;
      $this->userName = $userName;
      $this->password = $password;
      $this->externalReferenceGroup = $externalReferenceGroup;
    }

    /**
     * @return string
     */
    public function getCusOrderID()
    {
      return $this->cusOrderID;
    }

    /**
     * @param string $cusOrderID
     * @return \Visual\CustomerService\LoadCustomerDataByOrderID2
     */
    public function setCusOrderID($cusOrderID)
    {
      $this->cusOrderID = $cusOrderID;
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
     * @return \Visual\CustomerService\LoadCustomerDataByOrderID2
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
     * @return \Visual\CustomerService\LoadCustomerDataByOrderID2
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
     * @return \Visual\CustomerService\LoadCustomerDataByOrderID2
     */
    public function setPassword($password)
    {
      $this->password = $password;
      return $this;
    }

    /**
     * @return string
     */
    public function getExternalReferenceGroup()
    {
      return $this->externalReferenceGroup;
    }

    /**
     * @param string $externalReferenceGroup
     * @return \Visual\CustomerService\LoadCustomerDataByOrderID2
     */
    public function setExternalReferenceGroup($externalReferenceGroup)
    {
      $this->externalReferenceGroup = $externalReferenceGroup;
      return $this;
    }

}
