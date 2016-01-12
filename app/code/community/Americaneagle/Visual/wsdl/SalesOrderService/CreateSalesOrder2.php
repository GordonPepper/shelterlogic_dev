<?php

namespace Visual\SalesOrderService;

class CreateSalesOrder2
{

    /**
     * @var CustomerOrderData $data
     */
    protected $data = null;

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
     * @param CustomerOrderData $data
     * @param string $key
     * @param string $userName
     * @param string $password
     * @param string $externalRefGroup
     */
    public function __construct($data, $key, $userName, $password, $externalRefGroup)
    {
      $this->data = $data;
      $this->key = $key;
      $this->userName = $userName;
      $this->password = $password;
      $this->externalRefGroup = $externalRefGroup;
    }

    /**
     * @return CustomerOrderData
     */
    public function getData()
    {
      return $this->data;
    }

    /**
     * @param CustomerOrderData $data
     * @return \Visual\SalesOrderService\CreateSalesOrder2
     */
    public function setData($data)
    {
      $this->data = $data;
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
     * @return \Visual\SalesOrderService\CreateSalesOrder2
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
     * @return \Visual\SalesOrderService\CreateSalesOrder2
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
     * @return \Visual\SalesOrderService\CreateSalesOrder2
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
     * @return \Visual\SalesOrderService\CreateSalesOrder2
     */
    public function setExternalRefGroup($externalRefGroup)
    {
      $this->externalRefGroup = $externalRefGroup;
      return $this;
    }

}
