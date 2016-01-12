<?php

namespace Visual\InventoryService;

class TracePartLocations2Response
{

    /**
     * @var ArrayOfInventoryRequisitionTrace $TracePartLocations2Result
     */
    protected $TracePartLocations2Result = null;

    /**
     * @param ArrayOfInventoryRequisitionTrace $TracePartLocations2Result
     */
    public function __construct($TracePartLocations2Result)
    {
      $this->TracePartLocations2Result = $TracePartLocations2Result;
    }

    /**
     * @return ArrayOfInventoryRequisitionTrace
     */
    public function getTracePartLocations2Result()
    {
      return $this->TracePartLocations2Result;
    }

    /**
     * @param ArrayOfInventoryRequisitionTrace $TracePartLocations2Result
     * @return \Visual\InventoryService\TracePartLocations2Response
     */
    public function setTracePartLocations2Result($TracePartLocations2Result)
    {
      $this->TracePartLocations2Result = $TracePartLocations2Result;
      return $this;
    }

}
