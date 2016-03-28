<?php

namespace Visual\UserDefinedFieldService;

class SaveUserDefinedResponse
{

    /**
     * @var UserDefinedDataResponse $SaveUserDefinedResult
     */
    protected $SaveUserDefinedResult = null;

    /**
     * @param UserDefinedDataResponse $SaveUserDefinedResult
     */
    public function __construct($SaveUserDefinedResult)
    {
      $this->SaveUserDefinedResult = $SaveUserDefinedResult;
    }

    /**
     * @return UserDefinedDataResponse
     */
    public function getSaveUserDefinedResult()
    {
      return $this->SaveUserDefinedResult;
    }

    /**
     * @param UserDefinedDataResponse $SaveUserDefinedResult
     * @return \Visual\UserDefinedFieldService\SaveUserDefinedResponse
     */
    public function setSaveUserDefinedResult($SaveUserDefinedResult)
    {
      $this->SaveUserDefinedResult = $SaveUserDefinedResult;
      return $this;
    }

}
