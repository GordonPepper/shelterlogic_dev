<?php

namespace Visual\SalesOrderService;

class TestSetPrintedDate
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
     * @var string $Customer_ID
     */
    protected $Customer_ID = null;

    /**
     * @var string $Site_ID
     */
    protected $Site_ID = null;

    /**
     * @param string $key
     * @param string $userName
     * @param string $password
     * @param string $externalRefGroup
     * @param string $Customer_ID
     * @param string $Site_ID
     */
    public function __construct($key, $userName, $password, $externalRefGroup, $Customer_ID, $Site_ID)
    {
      $this->key = $key;
      $this->userName = $userName;
      $this->password = $password;
      $this->externalRefGroup = $externalRefGroup;
      $this->Customer_ID = $Customer_ID;
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
     * @return \Visual\SalesOrderService\TestSetPrintedDate
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
     * @return \Visual\SalesOrderService\TestSetPrintedDate
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
     * @return \Visual\SalesOrderService\TestSetPrintedDate
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
     * @return \Visual\SalesOrderService\TestSetPrintedDate
     */
    public function setExternalRefGroup($externalRefGroup)
    {
      $this->externalRefGroup = $externalRefGroup;
      return $this;
    }

    /**
     * @return string
     */
    public function getCustomer_ID()
    {
      return $this->Customer_ID;
    }

    /**
     * @param string $Customer_ID
     * @return \Visual\SalesOrderService\TestSetPrintedDate
     */
    public function setCustomer_ID($Customer_ID)
    {
      $this->Customer_ID = $Customer_ID;
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
     * @return \Visual\SalesOrderService\TestSetPrintedDate
     */
    public function setSite_ID($Site_ID)
    {
      $this->Site_ID = $Site_ID;
      return $this;
    }

}
