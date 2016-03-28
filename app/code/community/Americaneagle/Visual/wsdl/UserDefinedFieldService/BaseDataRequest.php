<?php

namespace Visual\UserDefinedFieldService;

class BaseDataRequest
{

    /**
     * @var boolean $ReturnErrorInResponse
     */
    protected $ReturnErrorInResponse = null;

    /**
     * @var boolean $UseIndependentTransactions
     */
    protected $UseIndependentTransactions = null;

    
    public function __construct()
    {
    
    }

    /**
     * @return boolean
     */
    public function getReturnErrorInResponse()
    {
      return $this->ReturnErrorInResponse;
    }

    /**
     * @param boolean $ReturnErrorInResponse
     * @return \Visual\UserDefinedFieldService\BaseDataRequest
     */
    public function setReturnErrorInResponse($ReturnErrorInResponse)
    {
      $this->ReturnErrorInResponse = $ReturnErrorInResponse;
      return $this;
    }

    /**
     * @return boolean
     */
    public function getUseIndependentTransactions()
    {
      return $this->UseIndependentTransactions;
    }

    /**
     * @param boolean $UseIndependentTransactions
     * @return \Visual\UserDefinedFieldService\BaseDataRequest
     */
    public function setUseIndependentTransactions($UseIndependentTransactions)
    {
      $this->UseIndependentTransactions = $UseIndependentTransactions;
      return $this;
    }

}
