<?php

namespace Visual\CustomerService;

class ConfigureNextNumberGenResponse
{

    /**
     * @var string $ConfigureNextNumberGenResult
     */
    protected $ConfigureNextNumberGenResult = null;

    /**
     * @param string $ConfigureNextNumberGenResult
     */
    public function __construct($ConfigureNextNumberGenResult)
    {
      $this->ConfigureNextNumberGenResult = $ConfigureNextNumberGenResult;
    }

    /**
     * @return string
     */
    public function getConfigureNextNumberGenResult()
    {
      return $this->ConfigureNextNumberGenResult;
    }

    /**
     * @param string $ConfigureNextNumberGenResult
     * @return \Visual\CustomerService\ConfigureNextNumberGenResponse
     */
    public function setConfigureNextNumberGenResult($ConfigureNextNumberGenResult)
    {
      $this->ConfigureNextNumberGenResult = $ConfigureNextNumberGenResult;
      return $this;
    }

}
