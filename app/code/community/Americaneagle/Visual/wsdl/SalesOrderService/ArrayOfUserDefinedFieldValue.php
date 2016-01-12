<?php

namespace Visual\SalesOrderService;

class ArrayOfUserDefinedFieldValue
{

    /**
     * @var UserDefinedFieldValue[] $UserDefinedFieldValue
     */
    protected $UserDefinedFieldValue = null;

    
    public function __construct()
    {
    
    }

    /**
     * @return UserDefinedFieldValue[]
     */
    public function getUserDefinedFieldValue()
    {
      return $this->UserDefinedFieldValue;
    }

    /**
     * @param UserDefinedFieldValue[] $UserDefinedFieldValue
     * @return \Visual\SalesOrderService\ArrayOfUserDefinedFieldValue
     */
    public function setUserDefinedFieldValue(array $UserDefinedFieldValue = null)
    {
      $this->UserDefinedFieldValue = $UserDefinedFieldValue;
      return $this;
    }

}
