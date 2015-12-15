<?php

namespace Visual\InventoryService;

class ArrayOfInventoryMaterialIssue
{

    /**
     * @var InventoryMaterialIssue[] $InventoryMaterialIssue
     */
    protected $InventoryMaterialIssue = null;

    
    public function __construct()
    {
    
    }

    /**
     * @return InventoryMaterialIssue[]
     */
    public function getInventoryMaterialIssue()
    {
      return $this->InventoryMaterialIssue;
    }

    /**
     * @param InventoryMaterialIssue[] $InventoryMaterialIssue
     * @return \Visual\InventoryService\ArrayOfInventoryMaterialIssue
     */
    public function setInventoryMaterialIssue(array $InventoryMaterialIssue = null)
    {
      $this->InventoryMaterialIssue = $InventoryMaterialIssue;
      return $this;
    }

}
