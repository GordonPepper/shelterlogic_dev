<?php

namespace Visual\SalesOrderService;

class CustomerOrderDS
{

    /**
     * @var CUSTOMER_ORDER $CUSTOMER_ORDER
     */
    protected $CUSTOMER_ORDER = null;

    /**
     * @param CUSTOMER_ORDER $CUSTOMER_ORDER
     */
    public function __construct($CUSTOMER_ORDER)
    {
      $this->CUSTOMER_ORDER = $CUSTOMER_ORDER;
    }

    /**
     * @return CUSTOMER_ORDER
     */
    public function getCUSTOMER_ORDER()
    {
      return $this->CUSTOMER_ORDER;
    }

    /**
     * @param CUSTOMER_ORDER $CUSTOMER_ORDER
     * @return \Visual\SalesOrderService\CustomerOrderDS
     */
    public function setCUSTOMER_ORDER($CUSTOMER_ORDER)
    {
      $this->CUSTOMER_ORDER = $CUSTOMER_ORDER;
      return $this;
    }

}
