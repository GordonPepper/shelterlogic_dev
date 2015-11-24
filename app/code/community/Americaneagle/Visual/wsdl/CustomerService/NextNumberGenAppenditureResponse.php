<?php

namespace Visual\CustomerService;

class NextNumberGenAppenditureResponse
{

    /**
     * @var string $NextNumberGenAppenditureResult
     */
    protected $NextNumberGenAppenditureResult = null;

    /**
     * @param string $NextNumberGenAppenditureResult
     */
    public function __construct($NextNumberGenAppenditureResult)
    {
      $this->NextNumberGenAppenditureResult = $NextNumberGenAppenditureResult;
    }

    /**
     * @return string
     */
    public function getNextNumberGenAppenditureResult()
    {
      return $this->NextNumberGenAppenditureResult;
    }

    /**
     * @param string $NextNumberGenAppenditureResult
     * @return \Visual\CustomerService\NextNumberGenAppenditureResponse
     */
    public function setNextNumberGenAppenditureResult($NextNumberGenAppenditureResult)
    {
      $this->NextNumberGenAppenditureResult = $NextNumberGenAppenditureResult;
      return $this;
    }

}
