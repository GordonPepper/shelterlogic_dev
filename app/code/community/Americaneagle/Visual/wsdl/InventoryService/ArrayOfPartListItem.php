<?php

namespace Visual\InventoryService;

class ArrayOfPartListItem
{

    /**
     * @var PartListItem[] $PartListItem
     */
    protected $PartListItem = null;

    
    public function __construct()
    {
    
    }

    /**
     * @return PartListItem[]
     */
    public function getPartListItem()
    {
      return $this->PartListItem;
    }

    /**
     * @param PartListItem[] $PartListItem
     * @return \Visual\InventoryService\ArrayOfPartListItem
     */
    public function setPartListItem(array $PartListItem = null)
    {
      $this->PartListItem = $PartListItem;
      return $this;
    }

}
