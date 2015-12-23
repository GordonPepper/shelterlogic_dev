<?php

namespace Visual\CustomerService;

class ArrayOfCustomerSite
{

    /**
     * @var CustomerSite[] $CustomerSite
     */
    protected $CustomerSite = null;

    
    public function __construct()
    {
    
    }

    /**
     * @return CustomerSite[]
     */
    public function getCustomerSite()
    {
      return $this->CustomerSite;
    }

    /**
     * @param CustomerSite[] $CustomerSite
     * @return \Visual\CustomerService\ArrayOfCustomerSite
     */
    public function setCustomerSite(array $CustomerSite = null)
    {
      $this->CustomerSite = $CustomerSite;
      return $this;
    }

}
