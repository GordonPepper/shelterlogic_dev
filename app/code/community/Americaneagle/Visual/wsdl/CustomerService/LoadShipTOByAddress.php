<?php

namespace Visual\CustomerService;

class LoadShipTOByAddress
{

    /**
     * @var string $customerID
     */
    protected $customerID = null;

    /**
     * @var CustomerAddress $data
     */
    protected $data = null;

    /**
     * @param string $customerID
     * @param CustomerAddress $data
     */
    public function __construct($customerID, $data)
    {
      $this->customerID = $customerID;
      $this->data = $data;
    }

    /**
     * @return string
     */
    public function getCustomerID()
    {
      return $this->customerID;
    }

    /**
     * @param string $customerID
     * @return \Visual\CustomerService\LoadShipTOByAddress
     */
    public function setCustomerID($customerID)
    {
      $this->customerID = $customerID;
      return $this;
    }

    /**
     * @return CustomerAddress
     */
    public function getData()
    {
      return $this->data;
    }

    /**
     * @param CustomerAddress $data
     * @return \Visual\CustomerService\LoadShipTOByAddress
     */
    public function setData($data)
    {
      $this->data = $data;
      return $this;
    }

}
