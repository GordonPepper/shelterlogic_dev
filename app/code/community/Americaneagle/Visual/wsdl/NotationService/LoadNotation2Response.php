<?php

namespace Visual\NotationService;

class LoadNotation2Response
{

    /**
     * @var string $LoadNotation2Result
     */
    protected $LoadNotation2Result = null;

    /**
     * @param string $LoadNotation2Result
     */
    public function __construct($LoadNotation2Result)
    {
      $this->LoadNotation2Result = $LoadNotation2Result;
    }

    /**
     * @return string
     */
    public function getLoadNotation2Result()
    {
      return $this->LoadNotation2Result;
    }

    /**
     * @param string $LoadNotation2Result
     * @return \Visual\NotationService\LoadNotation2Response
     */
    public function setLoadNotation2Result($LoadNotation2Result)
    {
      $this->LoadNotation2Result = $LoadNotation2Result;
      return $this;
    }

}
