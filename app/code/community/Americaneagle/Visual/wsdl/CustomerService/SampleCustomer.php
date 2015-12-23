<?php

namespace Visual\CustomerService;

class SampleCustomer
{

    /**
     * @var string $customerID
     */
    protected $customerID = null;

    /**
     * @var string $ExternalReferenceGroup
     */
    protected $ExternalReferenceGroup = null;

    /**
     * @param string $customerID
     * @param string $ExternalReferenceGroup
     */
    public function __construct($customerID, $ExternalReferenceGroup)
    {
      $this->customerID = $customerID;
      $this->ExternalReferenceGroup = $ExternalReferenceGroup;
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
     * @return \Visual\CustomerService\SampleCustomer
     */
    public function setCustomerID($customerID)
    {
      $this->customerID = $customerID;
      return $this;
    }

    /**
     * @return string
     */
    public function getExternalReferenceGroup()
    {
      return $this->ExternalReferenceGroup;
    }

    /**
     * @param string $ExternalReferenceGroup
     * @return \Visual\CustomerService\SampleCustomer
     */
    public function setExternalReferenceGroup($ExternalReferenceGroup)
    {
      $this->ExternalReferenceGroup = $ExternalReferenceGroup;
      return $this;
    }

}
