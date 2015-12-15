<?php

namespace Visual\InventoryService;

class TraceProfileExistsResponse
{

    /**
     * @var boolean $TraceProfileExistsResult
     */
    protected $TraceProfileExistsResult = null;

    /**
     * @param boolean $TraceProfileExistsResult
     */
    public function __construct($TraceProfileExistsResult)
    {
      $this->TraceProfileExistsResult = $TraceProfileExistsResult;
    }

    /**
     * @return boolean
     */
    public function getTraceProfileExistsResult()
    {
      return $this->TraceProfileExistsResult;
    }

    /**
     * @param boolean $TraceProfileExistsResult
     * @return \Visual\InventoryService\TraceProfileExistsResponse
     */
    public function setTraceProfileExistsResult($TraceProfileExistsResult)
    {
      $this->TraceProfileExistsResult = $TraceProfileExistsResult;
      return $this;
    }

}
