<?php

namespace Visual\UserDefinedFieldService;

class SaveUserDefined2Response
{

    /**
     * @var UserDefinedDataResponse $SaveUserDefined2Result
     */
    protected $SaveUserDefined2Result = null;

    /**
     * @param UserDefinedDataResponse $SaveUserDefined2Result
     */
    public function __construct($SaveUserDefined2Result)
    {
      $this->SaveUserDefined2Result = $SaveUserDefined2Result;
    }

    /**
     * @return UserDefinedDataResponse
     */
    public function getSaveUserDefined2Result()
    {
      return $this->SaveUserDefined2Result;
    }

    /**
     * @param UserDefinedDataResponse $SaveUserDefined2Result
     * @return \Visual\UserDefinedFieldService\SaveUserDefined2Response
     */
    public function setSaveUserDefined2Result($SaveUserDefined2Result)
    {
      $this->SaveUserDefined2Result = $SaveUserDefined2Result;
      return $this;
    }

}
