<?php

namespace Visual\NotationService;

class TestAddNotationResponse
{

    /**
     * @var string $TestAddNotationResult
     */
    protected $TestAddNotationResult = null;

    /**
     * @param string $TestAddNotationResult
     */
    public function __construct($TestAddNotationResult)
    {
      $this->TestAddNotationResult = $TestAddNotationResult;
    }

    /**
     * @return string
     */
    public function getTestAddNotationResult()
    {
      return $this->TestAddNotationResult;
    }

    /**
     * @param string $TestAddNotationResult
     * @return \Visual\NotationService\TestAddNotationResponse
     */
    public function setTestAddNotationResult($TestAddNotationResult)
    {
      $this->TestAddNotationResult = $TestAddNotationResult;
      return $this;
    }

}
