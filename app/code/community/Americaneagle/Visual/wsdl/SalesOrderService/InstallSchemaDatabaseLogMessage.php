<?php

namespace Visual\SalesOrderService;

class InstallSchemaDatabaseLogMessage
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
     * @param string $key
     * @param string $userName
     * @param string $password
     */
    public function __construct($key, $userName, $password)
    {
      $this->key = $key;
      $this->userName = $userName;
      $this->password = $password;
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
     * @return \Visual\SalesOrderService\InstallSchemaDatabaseLogMessage
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
     * @return \Visual\SalesOrderService\InstallSchemaDatabaseLogMessage
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
     * @return \Visual\SalesOrderService\InstallSchemaDatabaseLogMessage
     */
    public function setPassword($password)
    {
      $this->password = $password;
      return $this;
    }

}
