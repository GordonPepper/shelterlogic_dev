<?php

namespace Visual\UserDefinedFieldService;

class TestCreateUserDefinedResponse
{

    /**
     * @var UDFDataResponse $TestCreateUserDefinedResult
     */
    protected $TestCreateUserDefinedResult = null;

    /**
     * @param UDFDataResponse $TestCreateUserDefinedResult
     */
    public function __construct($TestCreateUserDefinedResult)
    {
      $this->TestCreateUserDefinedResult = $TestCreateUserDefinedResult;
    }

    /**
     * @return UDFDataResponse
     */
    public function getTestCreateUserDefinedResult()
    {
      return $this->TestCreateUserDefinedResult;
    }

    /**
     * @param UDFDataResponse $TestCreateUserDefinedResult
     * @return \Visual\UserDefinedFieldService\TestCreateUserDefinedResponse
     */
    public function setTestCreateUserDefinedResult($TestCreateUserDefinedResult)
    {
      $this->TestCreateUserDefinedResult = $TestCreateUserDefinedResult;
      return $this;
    }

}
