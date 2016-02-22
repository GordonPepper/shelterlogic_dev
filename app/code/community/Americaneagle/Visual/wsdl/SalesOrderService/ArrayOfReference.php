<?php

namespace Visual\SalesOrderService;

class ArrayOfReference
{

    /**
     * @var Reference[] $Reference
     */
    protected $Reference = null;

    
    public function __construct()
    {
    
    }

    /**
     * @return Reference[]
     */
    public function getReference()
    {
      return $this->Reference;
    }

    /**
     * @param Reference[] $Reference
     * @return \Visual\SalesOrderService\ArrayOfReference
     */
    public function setReference(array $Reference = null)
    {
      $this->Reference = $Reference;
      return $this;
    }

}
