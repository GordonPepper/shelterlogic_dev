<?php

namespace Visual\CustomerService;

class LoadCustomerDataByWebID
{

    /**
     * @var string $webID
     */
    protected $webID = null;

    /**
     * @param string $webID
     */
    public function __construct($webID)
    {
      $this->webID = $webID;
    }

    /**
     * @return string
     */
    public function getWebID()
    {
      return $this->webID;
    }

    /**
     * @param string $webID
     * @return \Visual\CustomerService\LoadCustomerDataByWebID
     */
    public function setWebID($webID)
    {
      $this->webID = $webID;
      return $this;
    }

}
