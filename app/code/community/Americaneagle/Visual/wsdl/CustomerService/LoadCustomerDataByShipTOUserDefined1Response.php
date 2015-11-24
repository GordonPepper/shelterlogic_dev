<?php

namespace Visual\CustomerService;

class LoadCustomerDataByShipTOUserDefined1Response
{

    /**
     * @var CustomerData $LoadCustomerDataByShipTOUserDefined1Result
     */
    protected $LoadCustomerDataByShipTOUserDefined1Result = null;

    /**
     * @param CustomerData $LoadCustomerDataByShipTOUserDefined1Result
     */
    public function __construct($LoadCustomerDataByShipTOUserDefined1Result)
    {
      $this->LoadCustomerDataByShipTOUserDefined1Result = $LoadCustomerDataByShipTOUserDefined1Result;
    }

    /**
     * @return CustomerData
     */
    public function getLoadCustomerDataByShipTOUserDefined1Result()
    {
      return $this->LoadCustomerDataByShipTOUserDefined1Result;
    }

    /**
     * @param CustomerData $LoadCustomerDataByShipTOUserDefined1Result
     * @return \Visual\CustomerService\LoadCustomerDataByShipTOUserDefined1Response
     */
    public function setLoadCustomerDataByShipTOUserDefined1Result($LoadCustomerDataByShipTOUserDefined1Result)
    {
      $this->LoadCustomerDataByShipTOUserDefined1Result = $LoadCustomerDataByShipTOUserDefined1Result;
      return $this;
    }

}
