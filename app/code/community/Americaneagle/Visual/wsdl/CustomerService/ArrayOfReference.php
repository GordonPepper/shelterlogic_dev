<?php

namespace Visual\CustomerService;

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
     * @return \Visual\CustomerService\ArrayOfReference
     */
    public function setReference(array $Reference = null)
    {
      $this->Reference = $Reference;
      return $this;
    }

}
