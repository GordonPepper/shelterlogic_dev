<?php

namespace Visual\UserDefinedFieldService;

class UserDefinedData extends BaseDataRequest
{

    /**
     * @var ArrayOfUserDefinedFieldValue $UserDefinedValues
     */
    protected $UserDefinedValues = null;

    
    public function __construct()
    {
      parent::__construct();
    }

    /**
     * @return ArrayOfUserDefinedFieldValue
     */
    public function getUserDefinedValues()
    {
      return $this->UserDefinedValues;
    }

    /**
     * @param ArrayOfUserDefinedFieldValue $UserDefinedValues
     * @return \Visual\UserDefinedFieldService\UserDefinedData
     */
    public function setUserDefinedValues($UserDefinedValues)
    {
      $this->UserDefinedValues = $UserDefinedValues;
      return $this;
    }

}
