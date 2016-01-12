<?php

namespace Visual\CustomerService;

class TestSampleResponse
{

    /**
     * @var string $TestSampleResult
     */
    protected $TestSampleResult = null;

    /**
     * @param string $TestSampleResult
     */
    public function __construct($TestSampleResult)
    {
      $this->TestSampleResult = $TestSampleResult;
    }

    /**
     * @return string
     */
    public function getTestSampleResult()
    {
      return $this->TestSampleResult;
    }

    /**
     * @param string $TestSampleResult
     * @return \Visual\CustomerService\TestSampleResponse
     */
    public function setTestSampleResult($TestSampleResult)
    {
      $this->TestSampleResult = $TestSampleResult;
      return $this;
    }

}
