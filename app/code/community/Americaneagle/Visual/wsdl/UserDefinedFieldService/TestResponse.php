<?php

namespace Visual\UserDefinedFieldService;

class TestResponse
{

    /**
     * @var UserDefinedDataResponse $TestResult
     */
    protected $TestResult = null;

    /**
     * @param UserDefinedDataResponse $TestResult
     */
    public function __construct($TestResult)
    {
      $this->TestResult = $TestResult;
    }

    /**
     * @return UserDefinedDataResponse
     */
    public function getTestResult()
    {
      return $this->TestResult;
    }

    /**
     * @param UserDefinedDataResponse $TestResult
     * @return \Visual\UserDefinedFieldService\TestResponse
     */
    public function setTestResult($TestResult)
    {
      $this->TestResult = $TestResult;
      return $this;
    }

}
