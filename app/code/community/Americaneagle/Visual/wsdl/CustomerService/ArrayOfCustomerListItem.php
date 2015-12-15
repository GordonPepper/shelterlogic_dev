<?php

namespace Visual\CustomerService;

class ArrayOfCustomerListItem
{

    /**
     * @var CustomerListItem[] $CustomerListItem
     */
    protected $CustomerListItem = null;

    
    public function __construct()
    {
    
    }

    /**
     * @return CustomerListItem[]
     */
    public function getCustomerListItem()
    {
      return $this->CustomerListItem;
    }

    /**
     * @param CustomerListItem[] $CustomerListItem
     * @return \Visual\CustomerService\ArrayOfCustomerListItem
     */
    public function setCustomerListItem(array $CustomerListItem = null)
    {
      $this->CustomerListItem = $CustomerListItem;
      return $this;
    }

}
