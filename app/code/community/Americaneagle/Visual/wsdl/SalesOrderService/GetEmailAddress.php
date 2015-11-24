<?php

namespace Visual\SalesOrderService;

class GetEmailAddress
{

    /**
     * @var string $custOrderID
     */
    protected $custOrderID = null;

    /**
     * @param string $custOrderID
     */
    public function __construct($custOrderID)
    {
      $this->custOrderID = $custOrderID;
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
     * @return \Visual\SalesOrderService\GetEmailAddress
     */
    public function setCustOrderID($custOrderID)
    {
      $this->custOrderID = $custOrderID;
      return $this;
    }

}
