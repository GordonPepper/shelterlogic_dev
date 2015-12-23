<?php

namespace Visual\SalesOrderService;

class GetEmailAddress2
{

    /**
     * @var string $custOrderID
     */
    protected $custOrderID = null;

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
     * @param string $custOrderID
     * @param string $key
     * @param string $userName
     * @param string $password
     */
    public function __construct($custOrderID, $key, $userName, $password)
    {
      $this->custOrderID = $custOrderID;
      $this->key = $key;
      $this->userName = $userName;
      $this->password = $password;
    }

    /**
     * @return string
     */
    public function getCustOrderID()
    {
      return $this->custOrderID;
    }

    /**
     * @param string $custOrderID
     * @return \Visual\SalesOrderService\GetEmailAddress2
     */
    public function setCustOrderID($custOrderID)
    {
      $this->custOrderID = $custOrderID;
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
     * @return \Visual\SalesOrderService\GetEmailAddress2
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
     * @return \Visual\SalesOrderService\GetEmailAddress2
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
     * @return \Visual\SalesOrderService\GetEmailAddress2
     */
    public function setPassword($password)
    {
      $this->password = $password;
      return $this;
    }

}
