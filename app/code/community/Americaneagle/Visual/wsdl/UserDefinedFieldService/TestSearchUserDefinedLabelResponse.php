<?php

namespace Visual\UserDefinedFieldService;

class TestSearchUserDefinedLabelResponse
{

    /**
     * @var UDFDataResponse $TestSearchUserDefinedLabelResult
     */
    protected $TestSearchUserDefinedLabelResult = null;

    /**
     * @param UDFDataResponse $TestSearchUserDefinedLabelResult
     */
    public function __construct($TestSearchUserDefinedLabelResult)
    {
      $this->TestSearchUserDefinedLabelResult = $TestSearchUserDefinedLabelResult;
    }

    /**
     * @return UDFDataResponse
     */
    public function getTestSearchUserDefinedLabelResult()
    {
      return $this->TestSearchUserDefinedLabelResult;
    }

    /**
     * @param UDFDataResponse $TestSearchUserDefinedLabelResult
     * @return \Visual\UserDefinedFieldService\TestSearchUserDefinedLabelResponse
     */
    public function setTestSearchUserDefinedLabelResult($TestSearchUserDefinedLabelResult)
    {
      $this->TestSearchUserDefinedLabelResult = $TestSearchUserDefinedLabelResult;
      return $this;
    }

}
