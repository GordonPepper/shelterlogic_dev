<?php

namespace Visual\CustomerService;

class LoadCustomerDataByOrderID
{

    /**
     * @var string $cusOrderID
     */
    protected $cusOrderID = null;

    /**
     * @param string $cusOrderID
     */
    public function __construct($cusOrderID)
    {
      $this->cusOrderID = $cusOrderID;
    }

    /**
     * @return string
     */
    public function getCusOrderID()
    {
      return $this->cusOrderID;
    }

    /**
     * @param string $cusOrderID
     * @return \Visual\CustomerService\LoadCustomerDataByOrderID
     */
    public function setCusOrderID($cusOrderID)
    {
      $this->cusOrderID = $cusOrderID;
      return $this;
    }

}
