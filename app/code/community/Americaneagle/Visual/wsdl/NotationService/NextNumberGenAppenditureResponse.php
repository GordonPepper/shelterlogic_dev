<?php

namespace Visual\NotationService;

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
     * @return \Visual\NotationService\NextNumberGenAppenditureResponse
     */
    public function setNextNumberGenAppenditureResult($NextNumberGenAppenditureResult)
    {
      $this->NextNumberGenAppenditureResult = $NextNumberGenAppenditureResult;
      return $this;
    }

}
