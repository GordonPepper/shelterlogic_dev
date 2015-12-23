<?php

namespace Visual\SalesOrderService;

class CreateSampleOrder
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
     * @var string $orderID
     */
    protected $orderID = null;

    /**
     * @var string $customerID
     */
    protected $customerID = null;

    /**
     * @var string $Site_ID
     */
    protected $Site_ID = null;

    /**
     * @param string $key
     * @param string $userName
     * @param string $password
     * @param string $externalRefGroup
     * @param string $orderID
     * @param string $customerID
     * @param string $Site_ID
     */
    public function __construct($key, $userName, $password, $externalRefGroup, $orderID, $customerID, $Site_ID)
    {
      $this->key = $key;
      $this->userName = $userName;
      $this->password = $password;
      $this->externalRefGroup = $externalRefGroup;
      $this->orderID = $orderID;
      $this->customerID = $customerID;
      $this->Site_ID = $Site_ID;
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
     * @return \Visual\SalesOrderService\CreateSampleOrder
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
     * @return \Visual\SalesOrderService\CreateSampleOrder
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
     * @return \Visual\SalesOrderService\CreateSampleOrder
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
     * @return \Visual\SalesOrderService\CreateSampleOrder
     */
    public function setExternalRefGroup($externalRefGroup)
    {
      $this->externalRefGroup = $externalRefGroup;
      return $this;
    }

    /**
     * @return string
     */
    public function getOrderID()
    {
      return $this->orderID;
    }

    /**
     * @param string $orderID
     * @return \Visual\SalesOrderService\CreateSampleOrder
     */
    public function setOrderID($orderID)
    {
      $this->orderID = $orderID;
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
     * @return \Visual\SalesOrderService\CreateSampleOrder
     */
    public function setCustomerID($customerID)
    {
      $this->customerID = $customerID;
      return $this;
    }

    /**
     * @return string
     */
    public function getSite_ID()
    {
      return $this->Site_ID;
    }

    /**
     * @param string $Site_ID
     * @return \Visual\SalesOrderService\CreateSampleOrder
     */
    public function setSite_ID($Site_ID)
    {
      $this->Site_ID = $Site_ID;
      return $this;
    }

}
