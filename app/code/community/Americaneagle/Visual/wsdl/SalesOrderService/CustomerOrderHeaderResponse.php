<?php

namespace Visual\SalesOrderService;

class CustomerOrderHeaderResponse extends BaseObjectResponse
{

    /**
     * @var CustomerOrderHeader $CustomerOrderHeader
     */
    protected $CustomerOrderHeader = null;

    /**
     * @param boolean $HasErrors
     */
    public function __construct($HasErrors)
    {
      parent::__construct($HasErrors);
    }

    /**
     * @return CustomerOrderHeader
     */
    public function getCustomerOrderHeader()
    {
      return $this->CustomerOrderHeader;
    }

    /**
     * @param CustomerOrderHeader $CustomerOrderHeader
     * @return \Visual\SalesOrderService\CustomerOrderHeaderResponse
     */
    public function setCustomerOrderHeader($CustomerOrderHeader)
    {
      $this->CustomerOrderHeader = $CustomerOrderHeader;
      return $this;
    }

}
