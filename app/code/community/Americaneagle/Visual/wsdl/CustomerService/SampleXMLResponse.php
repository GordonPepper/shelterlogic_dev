<?php

namespace Visual\CustomerService;

class SampleXMLResponse
{

    /**
     * @var CustomerData $SampleXMLResult
     */
    protected $SampleXMLResult = null;

    /**
     * @param CustomerData $SampleXMLResult
     */
    public function __construct($SampleXMLResult)
    {
      $this->SampleXMLResult = $SampleXMLResult;
    }

    /**
     * @return CustomerData
     */
    public function getSampleXMLResult()
    {
      return $this->SampleXMLResult;
    }

    /**
     * @param CustomerData $SampleXMLResult
     * @return \Visual\CustomerService\SampleXMLResponse
     */
    public function setSampleXMLResult($SampleXMLResult)
    {
      $this->SampleXMLResult = $SampleXMLResult;
      return $this;
    }

}
