<?php

namespace Visual\UserDefinedFieldService;

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
     * @return \Visual\UserDefinedFieldService\CurrentVersionResponse
     */
    public function setCurrentVersionResult($CurrentVersionResult)
    {
      $this->CurrentVersionResult = $CurrentVersionResult;
      return $this;
    }

}
