<?php

namespace Visual\UserDefinedFieldService;

class CreateUDFResponse
{

    /**
     * @var UDFDataResponse $CreateUDFResult
     */
    protected $CreateUDFResult = null;

    /**
     * @param UDFDataResponse $CreateUDFResult
     */
    public function __construct($CreateUDFResult)
    {
      $this->CreateUDFResult = $CreateUDFResult;
    }

    /**
     * @return UDFDataResponse
     */
    public function getCreateUDFResult()
    {
      return $this->CreateUDFResult;
    }

    /**
     * @param UDFDataResponse $CreateUDFResult
     * @return \Visual\UserDefinedFieldService\CreateUDFResponse
     */
    public function setCreateUDFResult($CreateUDFResult)
    {
      $this->CreateUDFResult = $CreateUDFResult;
      return $this;
    }

}
