<?php

namespace Visual\CustomerService;

class SearchCustomer
{

    /**
     * @var CustomerData $data
     */
    protected $data = null;

    /**
     * @param CustomerData $data
     */
    public function __construct($data)
    {
      $this->data = $data;
    }

    /**
     * @return CustomerData
     */
    public function getData()
    {
      return $this->data;
    }

    /**
     * @param CustomerData $data
     * @return \Visual\CustomerService\SearchCustomer
     */
    public function setData($data)
    {
      $this->data = $data;
      return $this;
    }

}
