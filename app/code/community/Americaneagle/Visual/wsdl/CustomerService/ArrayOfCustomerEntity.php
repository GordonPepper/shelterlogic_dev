<?php

namespace Visual\CustomerService;

class ArrayOfCustomerEntity
{

    /**
     * @var CustomerEntity[] $CustomerEntity
     */
    protected $CustomerEntity = null;

    
    public function __construct()
    {
    
    }

    /**
     * @return CustomerEntity[]
     */
    public function getCustomerEntity()
    {
      return $this->CustomerEntity;
    }

    /**
     * @param CustomerEntity[] $CustomerEntity
     * @return \Visual\CustomerService\ArrayOfCustomerEntity
     */
    public function setCustomerEntity(array $CustomerEntity = null)
    {
      $this->CustomerEntity = $CustomerEntity;
      return $this;
    }

}
