<?php

namespace Visual\InventoryService;

class TracePartLocationsResponse
{

    /**
     * @var ArrayOfInventoryRequisitionTrace $TracePartLocationsResult
     */
    protected $TracePartLocationsResult = null;

    /**
     * @param ArrayOfInventoryRequisitionTrace $TracePartLocationsResult
     */
    public function __construct($TracePartLocationsResult)
    {
      $this->TracePartLocationsResult = $TracePartLocationsResult;
    }

    /**
     * @return ArrayOfInventoryRequisitionTrace
     */
    public function getTracePartLocationsResult()
    {
      return $this->TracePartLocationsResult;
    }

    /**
     * @param ArrayOfInventoryRequisitionTrace $TracePartLocationsResult
     * @return \Visual\InventoryService\TracePartLocationsResponse
     */
    public function setTracePartLocationsResult($TracePartLocationsResult)
    {
      $this->TracePartLocationsResult = $TracePartLocationsResult;
      return $this;
    }

}
