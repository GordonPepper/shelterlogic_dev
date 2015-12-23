<?php

namespace Visual\CustomerService;

class LoginCredsResponse
{

    /**
     * @var string $LoginCredsResult
     */
    protected $LoginCredsResult = null;

    /**
     * @param string $LoginCredsResult
     */
    public function __construct($LoginCredsResult)
    {
      $this->LoginCredsResult = $LoginCredsResult;
    }

    /**
     * @return string
     */
    public function getLoginCredsResult()
    {
      return $this->LoginCredsResult;
    }

    /**
     * @param string $LoginCredsResult
     * @return \Visual\CustomerService\LoginCredsResponse
     */
    public function setLoginCredsResult($LoginCredsResult)
    {
      $this->LoginCredsResult = $LoginCredsResult;
      return $this;
    }

}