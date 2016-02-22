<?php

namespace Visual\CustomerService;

class LoadCustomerDataByShipTOUserDefined1
{

    /**
     * @var string $customerID
     */
    protected $customerID = null;

    /**
     * @var string $userDefined1
     */
    protected $userDefined1 = null;

    /**
     * @param string $customerID
     * @param string $userDefined1
     */
    public function __construct($customerID, $userDefined1)
    {
      $this->customerID = $customerID;
      $this->userDefined1 = $userDefined1;
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
     * @return \Visual\CustomerService\LoadCustomerDataByShipTOUserDefined1
     */
    public function setCustomerID($customerID)
    {
      $this->customerID = $customerID;
      return $this;
    }

    /**
     * @return string
     */
    public function getUserDefined1()
    {
      return $this->userDefined1;
    }

    /**
     * @param string $userDefined1
     * @return \Visual\CustomerService\LoadCustomerDataByShipTOUserDefined1
     */
    public function setUserDefined1($userDefined1)
    {
      $this->userDefined1 = $userDefined1;
      return $this;
    }

}
