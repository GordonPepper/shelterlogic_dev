<?php

namespace Visual\CustomerService;

abstract class ExternalReference
{

    /**
     * @var ArrayOfReference $ReferenceList
     */
    protected $ReferenceList = null;

    
    public function __construct()
    {
    
    }

    /**
     * @return ArrayOfReference
     */
    public function getReferenceList()
    {
      return $this->ReferenceList;
    }

    /**
     * @param ArrayOfReference $ReferenceList
     * @return \Visual\CustomerService\ExternalReference
     */
    public function setReferenceList($ReferenceList)
    {
      $this->ReferenceList = $ReferenceList;
      return $this;
    }

}
