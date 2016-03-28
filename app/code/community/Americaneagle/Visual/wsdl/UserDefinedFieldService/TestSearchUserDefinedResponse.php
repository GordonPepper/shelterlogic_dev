<?php

namespace Visual\UserDefinedFieldService;

class TestSearchUserDefinedResponse
{

    /**
     * @var UDFDataResponse $TestSearchUserDefinedResult
     */
    protected $TestSearchUserDefinedResult = null;

    /**
     * @param UDFDataResponse $TestSearchUserDefinedResult
     */
    public function __construct($TestSearchUserDefinedResult)
    {
      $this->TestSearchUserDefinedResult = $TestSearchUserDefinedResult;
    }

    /**
     * @return UDFDataResponse
     */
    public function getTestSearchUserDefinedResult()
    {
      return $this->TestSearchUserDefinedResult;
    }

    /**
     * @param UDFDataResponse $TestSearchUserDefinedResult
     * @return \Visual\UserDefinedFieldService\TestSearchUserDefinedResponse
     */
    public function setTestSearchUserDefinedResult($TestSearchUserDefinedResult)
    {
      $this->TestSearchUserDefinedResult = $TestSearchUserDefinedResult;
      return $this;
    }

}
