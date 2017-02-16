<?php

namespace Visual\SalesOrderService;

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
     * @return \Visual\SalesOrderService\CurrentVersionResponse
     */
    public function setCurrentVersionResult($CurrentVersionResult)
    {
      $this->CurrentVersionResult = $CurrentVersionResult;
      return $this;
    }

}
