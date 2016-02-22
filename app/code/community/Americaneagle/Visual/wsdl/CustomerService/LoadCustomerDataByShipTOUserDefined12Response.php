<?php

namespace Visual\CustomerService;

class LoadCustomerDataByShipTOUserDefined12Response
{

    /**
     * @var CustomerData $LoadCustomerDataByShipTOUserDefined12Result
     */
    protected $LoadCustomerDataByShipTOUserDefined12Result = null;

    /**
     * @param CustomerData $LoadCustomerDataByShipTOUserDefined12Result
     */
    public function __construct($LoadCustomerDataByShipTOUserDefined12Result)
    {
      $this->LoadCustomerDataByShipTOUserDefined12Result = $LoadCustomerDataByShipTOUserDefined12Result;
    }

    /**
     * @return CustomerData
     */
    public function getLoadCustomerDataByShipTOUserDefined12Result()
    {
      return $this->LoadCustomerDataByShipTOUserDefined12Result;
    }

    /**
     * @param CustomerData $LoadCustomerDataByShipTOUserDefined12Result
     * @return \Visual\CustomerService\LoadCustomerDataByShipTOUserDefined12Response
     */
    public function setLoadCustomerDataByShipTOUserDefined12Result($LoadCustomerDataByShipTOUserDefined12Result)
    {
      $this->LoadCustomerDataByShipTOUserDefined12Result = $LoadCustomerDataByShipTOUserDefined12Result;
      return $this;
    }

}
