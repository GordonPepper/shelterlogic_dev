<?php

namespace Visual\NotationService;

class LoadNotationResponse
{

    /**
     * @var string $LoadNotationResult
     */
    protected $LoadNotationResult = null;

    /**
     * @param string $LoadNotationResult
     */
    public function __construct($LoadNotationResult)
    {
      $this->LoadNotationResult = $LoadNotationResult;
    }

    /**
     * @return string
     */
    public function getLoadNotationResult()
    {
      return $this->LoadNotationResult;
    }

    /**
     * @param string $LoadNotationResult
     * @return \Visual\NotationService\LoadNotationResponse
     */
    public function setLoadNotationResult($LoadNotationResult)
    {
      $this->LoadNotationResult = $LoadNotationResult;
      return $this;
    }

}
