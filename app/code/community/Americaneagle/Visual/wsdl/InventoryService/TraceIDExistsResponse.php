<?php

namespace Visual\InventoryService;

class TraceIDExistsResponse
{

    /**
     * @var boolean $TraceIDExistsResult
     */
    protected $TraceIDExistsResult = null;

    /**
     * @param boolean $TraceIDExistsResult
     */
    public function __construct($TraceIDExistsResult)
    {
      $this->TraceIDExistsResult = $TraceIDExistsResult;
    }

    /**
     * @return boolean
     */
    public function getTraceIDExistsResult()
    {
      return $this->TraceIDExistsResult;
    }

    /**
     * @param boolean $TraceIDExistsResult
     * @return \Visual\InventoryService\TraceIDExistsResponse
     */
    public function setTraceIDExistsResult($TraceIDExistsResult)
    {
      $this->TraceIDExistsResult = $TraceIDExistsResult;
      return $this;
    }

}
