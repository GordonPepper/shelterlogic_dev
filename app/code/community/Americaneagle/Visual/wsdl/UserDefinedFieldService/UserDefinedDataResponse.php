<?php

namespace Visual\UserDefinedFieldService;

class UserDefinedDataResponse extends BaseDataResponse
{

    /**
     * @var ArrayOfUserDefinedFieldValueResponse $UserDefinedFieldValues
     */
    protected $UserDefinedFieldValues = null;

    /**
     * @param boolean $HasErrors
     * @param \DateTime $SubmitDateTime
     * @param \DateTime $ResponseDateTime
     */
    public function __construct($HasErrors, \DateTime $SubmitDateTime, \DateTime $ResponseDateTime)
    {
      parent::__construct($HasErrors, $SubmitDateTime, $ResponseDateTime);
    }

    /**
     * @return ArrayOfUserDefinedFieldValueResponse
     */
    public function getUserDefinedFieldValues()
    {
      return $this->UserDefinedFieldValues;
    }

    /**
     * @param ArrayOfUserDefinedFieldValueResponse $UserDefinedFieldValues
     * @return \Visual\UserDefinedFieldService\UserDefinedDataResponse
     */
    public function setUserDefinedFieldValues($UserDefinedFieldValues)
    {
      $this->UserDefinedFieldValues = $UserDefinedFieldValues;
      return $this;
    }

}
