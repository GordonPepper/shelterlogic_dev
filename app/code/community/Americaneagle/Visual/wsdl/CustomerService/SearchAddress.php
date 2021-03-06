<?php

namespace Visual\CustomerService;

class SearchAddress
{

    /**
     * @var AddressData $data
     */
    protected $data = null;

    /**
     * @param AddressData $data
     */
    public function __construct($data)
    {
      $this->data = $data;
    }

    /**
     * @return AddressData
     */
    public function getData()
    {
      return $this->data;
    }

    /**
     * @param AddressData $data
     * @return \Visual\CustomerService\SearchAddress
     */
    public function setData($data)
    {
      $this->data = $data;
      return $this;
    }

}
