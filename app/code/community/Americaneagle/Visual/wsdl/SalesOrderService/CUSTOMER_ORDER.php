<?php

namespace Visual\SalesOrderService;

class CUSTOMER_ORDER
{

    /**
     * @var string $ID
     */
    protected $ID = null;

    /**
     * @var \DateTime $PRINTED_DATE
     */
    protected $PRINTED_DATE = null;

    /**
     * @var boolean $SELECTED
     */
    protected $SELECTED = null;

    /**
     * @param string $ID
     * @param \DateTime $PRINTED_DATE
     * @param boolean $SELECTED
     */
    public function __construct($ID, \DateTime $PRINTED_DATE, $SELECTED)
    {
      $this->ID = $ID;
      $this->PRINTED_DATE = $PRINTED_DATE->format(\DateTime::ATOM);
      $this->SELECTED = $SELECTED;
    }

    /**
     * @return string
     */
    public function getID()
    {
      return $this->ID;
    }

    /**
     * @param string $ID
     * @return \Visual\SalesOrderService\CUSTOMER_ORDER
     */
    public function setID($ID)
    {
      $this->ID = $ID;
      return $this;
    }

    /**
     * @return \DateTime
     */
    public function getPRINTED_DATE()
    {
      if ($this->PRINTED_DATE == null) {
        return null;
      } else {
        try {
          return new \DateTime($this->PRINTED_DATE);
        } catch (\Exception $e) {
          return false;
        }
      }
    }

    /**
     * @param \DateTime $PRINTED_DATE
     * @return \Visual\SalesOrderService\CUSTOMER_ORDER
     */
    public function setPRINTED_DATE(\DateTime $PRINTED_DATE)
    {
      $this->PRINTED_DATE = $PRINTED_DATE->format(\DateTime::ATOM);
      return $this;
    }

    /**
     * @return boolean
     */
    public function getSELECTED()
    {
      return $this->SELECTED;
    }

    /**
     * @param boolean $SELECTED
     * @return \Visual\SalesOrderService\CUSTOMER_ORDER
     */
    public function setSELECTED($SELECTED)
    {
      $this->SELECTED = $SELECTED;
      return $this;
    }

}
