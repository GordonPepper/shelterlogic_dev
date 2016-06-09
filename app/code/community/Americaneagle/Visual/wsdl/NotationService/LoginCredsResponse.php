<?php

namespace Visual\NotationService;

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
     * @return \Visual\NotationService\LoginCredsResponse
     */
    public function setLoginCredsResult($LoginCredsResult)
    {
      $this->LoginCredsResult = $LoginCredsResult;
      return $this;
    }

}
