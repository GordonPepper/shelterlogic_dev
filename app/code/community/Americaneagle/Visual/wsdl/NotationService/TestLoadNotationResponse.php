<?php

namespace Visual\NotationService;

class TestLoadNotationResponse
{

    /**
     * @var string $TestLoadNotationResult
     */
    protected $TestLoadNotationResult = null;

    /**
     * @param string $TestLoadNotationResult
     */
    public function __construct($TestLoadNotationResult)
    {
      $this->TestLoadNotationResult = $TestLoadNotationResult;
    }

    /**
     * @return string
     */
    public function getTestLoadNotationResult()
    {
      return $this->TestLoadNotationResult;
    }

    /**
     * @param string $TestLoadNotationResult
     * @return \Visual\NotationService\TestLoadNotationResponse
     */
    public function setTestLoadNotationResult($TestLoadNotationResult)
    {
      $this->TestLoadNotationResult = $TestLoadNotationResult;
      return $this;
    }

}
