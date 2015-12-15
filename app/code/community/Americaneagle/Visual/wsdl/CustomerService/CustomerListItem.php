<?php

namespace Visual\CustomerService;

class CustomerListItem
{

    /**
     * @var int $SequenceNo
     */
    protected $SequenceNo = null;

    /**
     * @var string $ID
     */
    protected $ID = null;

    /**
     * @var Customer $Customer
     */
    protected $Customer = null;

    /**
     * @param int $SequenceNo
     */
    public function __construct($SequenceNo)
    {
      $this->SequenceNo = $SequenceNo;
    }

    /**
     * @return int
     */
    public function getSequenceNo()
    {
      return $this->SequenceNo;
    }

    /**
     * @param int $SequenceNo
     * @return \Visual\CustomerService\CustomerListItem
     */
    public function setSequenceNo($SequenceNo)
    {
      $this->SequenceNo = $SequenceNo;
      return $this;
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
     * @return \Visual\CustomerService\CustomerListItem
     */
    public function setID($ID)
    {
      $this->ID = $ID;
      return $this;
    }

    /**
     * @return Customer
     */
    public function getCustomer()
    {
      return $this->Customer;
    }

    /**
     * @param Customer $Customer
     * @return \Visual\CustomerService\CustomerListItem
     */
    public function setCustomer($Customer)
    {
      $this->Customer = $Customer;
      return $this;
    }

}
