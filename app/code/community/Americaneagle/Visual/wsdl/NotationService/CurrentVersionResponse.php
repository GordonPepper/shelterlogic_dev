<?php

namespace Visual\NotationService;

class CurrentVersionResponse
{

    /**
     * @var string $CurrentVersionResult
     */
    protected $CurrentVersionResult = null;

    /**
     * @param string $CurrentVersionResult
     */
    public function __construct($CurrentVersionResult)
    {
      $this->CurrentVersionResult = $CurrentVersionResult;
    }

    /**
     * @return string
     */
    public function getCurrentVersionResult()
    {
      return $this->CurrentVersionResult;
    }

    /**
     * @param string $CurrentVersionResult
     * @return \Visual\NotationService\CurrentVersionResponse
     */
    public function setCurrentVersionResult($CurrentVersionResult)
    {
      $this->CurrentVersionResult = $CurrentVersionResult;
      return $this;
    }

}
