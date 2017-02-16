<?php

namespace Visual\InventoryService;

class ProcessInventoryTransaction2Response
{

    /**
     * @var InventoryTransactionData $ProcessInventoryTransaction2Result
     */
    protected $ProcessInventoryTransaction2Result = null;

    /**
     * @param InventoryTransactionData $ProcessInventoryTransaction2Result
     */
    public function __construct($ProcessInventoryTransaction2Result)
    {
      $this->ProcessInventoryTransaction2Result = $ProcessInventoryTransaction2Result;
    }

    /**
     * @return InventoryTransactionData
     */
    public function getProcessInventoryTransaction2Result()
    {
      return $this->ProcessInventoryTransaction2Result;
    }

    /**
     * @param InventoryTransactionData $ProcessInventoryTransaction2Result
     * @return \Visual\InventoryService\ProcessInventoryTransaction2Response
     */
    public function setProcessInventoryTransaction2Result($ProcessInventoryTransaction2Result)
    {
      $this->ProcessInventoryTransaction2Result = $ProcessInventoryTransaction2Result;
      return $this;
    }

}
