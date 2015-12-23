<?php

namespace Visual\CustomerService;

class CustomerDataResponse extends BaseDataResponse
{

    /**
     * @var int $CustomerCount
     */
    protected $CustomerCount = null;

    /**
     * @var ArrayOfCustomerListItem $CustomerList
     */
    protected $CustomerList = null;

    /**
     * @param boolean $HasErrors
     * @param \DateTime $SubmitDateTime
     * @param \DateTime $ResponseDateTime
     * @param int $CustomerCount
     */
    public function __construct($HasErrors, \DateTime $SubmitDateTime, \DateTime $ResponseDateTime, $CustomerCount)
    {
      parent::__construct($HasErrors, $SubmitDateTime, $ResponseDateTime);
      $this->CustomerCount = $CustomerCount;
    }

    /**
     * @return int
     */
    public function getCustomerCount()
    {
      return $this->CustomerCount;
    }

    /**
     * @param int $CustomerCount
     * @return \Visual\CustomerService\CustomerDataResponse
     */
    public function setCustomerCount($CustomerCount)
    {
      $this->CustomerCount = $CustomerCount;
      return $this;
    }

    /**
     * @return ArrayOfCustomerListItem
     */
    public function getCustomerList()
    {
      return $this->CustomerList;
    }

    /**
     * @param ArrayOfCustomerListItem $CustomerList
     * @return \Visual\CustomerService\CustomerDataResponse
     */
    public function setCustomerList($CustomerList)
    {
      $this->CustomerList = $CustomerList;
      return $this;
    }

}
