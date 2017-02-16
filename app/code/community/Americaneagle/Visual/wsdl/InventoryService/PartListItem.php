<?php

namespace Visual\InventoryService;

class PartListItem
{

    /**
     * @var int $SequenceNo
     */
    protected $SequenceNo = null;

    /**
     * @var string $ID
     */
    protected $ID = null;

    /**
     * @var Part $Part
     */
    protected $Part = null;

    /**
     * @param int $SequenceNo
     */
    public function __construct($SequenceNo)
    {
      $this->SequenceNo = $SequenceNo;
    }

    /**
     * @return int
     */
    public function getSequenceNo()
    {
      return $this->SequenceNo;
    }

    /**
     * @param int $SequenceNo
     * @return \Visual\InventoryService\PartListItem
     */
    public function setSequenceNo($SequenceNo)
    {
      $this->SequenceNo = $SequenceNo;
      return $this;
    }

    /**
     * @return string
     */
    public function getID()
    {
      return $this->ID;
    }

    /**
     * @param string $ID
     * @return \Visual\InventoryService\PartListItem
     */
    public function setID($ID)
    {
      $this->ID = $ID;
      return $this;
    }

    /**
     * @return Part
     */
    public function getPart()
    {
      return $this->Part;
    }

    /**
     * @param Part $Part
     * @return \Visual\InventoryService\PartListItem
     */
    public function setPart($Part)
    {
      $this->Part = $Part;
      return $this;
    }

}
