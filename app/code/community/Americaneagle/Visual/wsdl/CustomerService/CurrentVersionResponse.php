<?php

namespace Visual\CustomerService;

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
     * @return \Visual\CustomerService\CurrentVersionResponse
     */
    public function setCurrentVersionResult($CurrentVersionResult)
    {
      $this->CurrentVersionResult = $CurrentVersionResult;
      return $this;
    }

}
