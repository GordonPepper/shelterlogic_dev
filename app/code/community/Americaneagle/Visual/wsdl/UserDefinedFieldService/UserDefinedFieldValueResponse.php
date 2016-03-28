<?php

namespace Visual\UserDefinedFieldService;

class UserDefinedFieldValueResponse extends BaseObjectResponse
{

    /**
     * @var UserDefinedFieldValue $UserDefinedFieldValue
     */
    protected $UserDefinedFieldValue = null;

    /**
     * @param boolean $HasErrors
     */
    public function __construct($HasErrors)
    {
      parent::__construct($HasErrors);
    }

    /**
     * @return UserDefinedFieldValue
     */
    public function getUserDefinedFieldValue()
    {
      return $this->UserDefinedFieldValue;
    }

    /**
     * @param UserDefinedFieldValue $UserDefinedFieldValue
     * @return \Visual\UserDefinedFieldService\UserDefinedFieldValueResponse
     */
    public function setUserDefinedFieldValue($UserDefinedFieldValue)
    {
      $this->UserDefinedFieldValue = $UserDefinedFieldValue;
      return $this;
    }

}
