<?php

namespace Visual\SalesOrderService;

class Header
{

    /**
     * @var string $Key
     */
    protected $Key = null;

    /**
     * @var string $UserName
     */
    protected $UserName = null;

    /**
     * @var string $Password
     */
    protected $Password = null;

    /**
     * @var string $ExternalRefGroup
     */
    protected $ExternalRefGroup = null;

    
    public function __construct()
    {
    
    }

    /**
     * @return string
     */
    public function getKey()
    {
      return $this->Key;
    }

    /**
     * @param string $Key
     * @return \Visual\SalesOrderService\Header
     */
    public function setKey($Key)
    {
      $this->Key = $Key;
      return $this;
    }

    /**
     * @return string
     */
    public function getUserName()
    {
      return $this->UserName;
    }

    /**
     * @param string $UserName
     * @return \Visual\SalesOrderService\Header
     */
    public function setUserName($UserName)
    {
      $this->UserName = $UserName;
      return $this;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
      return $this->Password;
    }

    /**
     * @param string $Password
     * @return \Visual\SalesOrderService\Header
     */
    public function setPassword($Password)
    {
      $this->Password = $Password;
      return $this;
    }

    /**
     * @return string
     */
    public function getExternalRefGroup()
    {
      return $this->ExternalRefGroup;
    }

    /**
     * @param string $ExternalRefGroup
     * @return \Visual\SalesOrderService\Header
     */
    public function setExternalRefGroup($ExternalRefGroup)
    {
      $this->ExternalRefGroup = $ExternalRefGroup;
      return $this;
    }

}
