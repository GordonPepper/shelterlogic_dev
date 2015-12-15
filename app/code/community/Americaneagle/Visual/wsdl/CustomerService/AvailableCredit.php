<?php

namespace Visual\CustomerService;

class AvailableCredit
{

    /**
     * @var string $customerID
     */
    protected $customerID = null;

    /**
     * @var string $entityID
     */
    protected $entityID = null;

    /**
     * @param string $customerID
     * @param string $entityID
     */
    public function __construct($customerID, $entityID)
    {
      $this->customerID = $customerID;
      $this->entityID = $entityID;
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
     * @return \Visual\CustomerService\AvailableCredit
     */
    public function setCustomerID($customerID)
    {
      $this->customerID = $customerID;
      return $this;
    }

    /**
     * @return string
     */
    public function getEntityID()
    {
      return $this->entityID;
    }

    /**
     * @param string $entityID
     * @return \Visual\CustomerService\AvailableCredit
     */
    public function setEntityID($entityID)
    {
      $this->entityID = $entityID;
      return $this;
    }

}
