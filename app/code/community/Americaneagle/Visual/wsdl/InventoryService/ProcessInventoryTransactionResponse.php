<?php

namespace Visual\InventoryService;

class ProcessInventoryTransactionResponse
{

    /**
     * @var InventoryTransactionData $ProcessInventoryTransactionResult
     */
    protected $ProcessInventoryTransactionResult = null;

    /**
     * @param InventoryTransactionData $ProcessInventoryTransactionResult
     */
    public function __construct($ProcessInventoryTransactionResult)
    {
      $this->ProcessInventoryTransactionResult = $ProcessInventoryTransactionResult;
    }

    /**
     * @return InventoryTransactionData
     */
    public function getProcessInventoryTransactionResult()
    {
      return $this->ProcessInventoryTransactionResult;
    }

    /**
     * @param InventoryTransactionData $ProcessInventoryTransactionResult
     * @return \Visual\InventoryService\ProcessInventoryTransactionResponse
     */
    public function setProcessInventoryTransactionResult($ProcessInventoryTransactionResult)
    {
      $this->ProcessInventoryTransactionResult = $ProcessInventoryTransactionResult;
      return $this;
    }

}
