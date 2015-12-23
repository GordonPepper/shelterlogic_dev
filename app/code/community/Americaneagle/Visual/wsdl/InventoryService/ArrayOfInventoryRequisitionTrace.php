<?php

namespace Visual\InventoryService;

class ArrayOfInventoryRequisitionTrace
{

    /**
     * @var InventoryRequisitionTrace[] $InventoryRequisitionTrace
     */
    protected $InventoryRequisitionTrace = null;

    
    public function __construct()
    {
    
    }

    /**
     * @return InventoryRequisitionTrace[]
     */
    public function getInventoryRequisitionTrace()
    {
      return $this->InventoryRequisitionTrace;
    }

    /**
     * @param InventoryRequisitionTrace[] $InventoryRequisitionTrace
     * @return \Visual\InventoryService\ArrayOfInventoryRequisitionTrace
     */
    public function setInventoryRequisitionTrace(array $InventoryRequisitionTrace = null)
    {
      $this->InventoryRequisitionTrace = $InventoryRequisitionTrace;
      return $this;
    }

}
