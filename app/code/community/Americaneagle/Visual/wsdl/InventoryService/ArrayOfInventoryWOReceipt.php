<?php

namespace Visual\InventoryService;

class ArrayOfInventoryWOReceipt
{

    /**
     * @var InventoryWOReceipt[] $InventoryWOReceipt
     */
    protected $InventoryWOReceipt = null;

    
    public function __construct()
    {
    
    }

    /**
     * @return InventoryWOReceipt[]
     */
    public function getInventoryWOReceipt()
    {
      return $this->InventoryWOReceipt;
    }

    /**
     * @param InventoryWOReceipt[] $InventoryWOReceipt
     * @return \Visual\InventoryService\ArrayOfInventoryWOReceipt
     */
    public function setInventoryWOReceipt(array $InventoryWOReceipt = null)
    {
      $this->InventoryWOReceipt = $InventoryWOReceipt;
      return $this;
    }

}
