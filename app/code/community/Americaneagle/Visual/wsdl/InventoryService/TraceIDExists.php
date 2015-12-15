<?php

namespace Visual\InventoryService;

class TraceIDExists
{

    /**
     * @var string $partID
     */
    protected $partID = null;

    /**
     * @var string $traceID
     */
    protected $traceID = null;

    /**
     * @param string $partID
     * @param string $traceID
     */
    public function __construct($partID, $traceID)
    {
      $this->partID = $partID;
      $this->traceID = $traceID;
    }

    /**
     * @return string
     */
    public function getPartID()
    {
      return $this->partID;
    }

    /**
     * @param string $partID
     * @return \Visual\InventoryService\TraceIDExists
     */
    public function setPartID($partID)
    {
      $this->partID = $partID;
      return $this;
    }

    /**
     * @return string
     */
    public function getTraceID()
    {
      return $this->traceID;
    }

    /**
     * @param string $traceID
     * @return \Visual\InventoryService\TraceIDExists
     */
    public function setTraceID($traceID)
    {
      $this->traceID = $traceID;
      return $this;
    }

}
