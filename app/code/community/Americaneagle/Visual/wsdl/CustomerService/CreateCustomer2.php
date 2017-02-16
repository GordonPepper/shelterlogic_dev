<?php

namespace Visual\CustomerService;

class CreateCustomer2
{

    /**
     * @var CustomerData $data
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
     * @param CustomerData $data
     * @param string $key
     * @param string $userName
     * @param string $password
     */
    public function __construct($data, $key, $userName, $password)
    {
      $this->data = $data;
      $this->key = $key;
      $this->userName = $userName;
      $this->password = $password;
    }

    /**
     * @return CustomerData
     */
    public function getData()
    {
      return $this->data;
    }

    /**
     * @param CustomerData $data
     * @return \Visual\CustomerService\CreateCustomer2
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
     * @return \Visual\CustomerService\CreateCustomer2
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
     * @return \Visual\CustomerService\CreateCustomer2
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
     * @return \Visual\CustomerService\CreateCustomer2
     */
    public function setPassword($password)
    {
      $this->password = $password;
      return $this;
    }

}
