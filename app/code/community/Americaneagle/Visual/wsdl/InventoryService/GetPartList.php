<?php

namespace Visual\InventoryService;

class GetPartList
{

    /**
     * @var string $SiteId
     */
    protected $SiteId = null;

    /**
     * @var string $ListOnly
     */
    protected $ListOnly = null;

    /**
     * @var int $Start
     */
    protected $Start = null;

    /**
     * @var int $Count
     */
    protected $Count = null;

    /**
     * @var string $ReverseSort
     */
    protected $ReverseSort = null;

    /**
     * @var string $PartId
     */
    protected $PartId = null;

    /**
     * @param string $SiteId
     * @param string $ListOnly
     * @param int $Start
     * @param int $Count
     * @param string $ReverseSort
     * @param string $PartId
     */
    public function __construct($SiteId, $ListOnly, $Start, $Count, $ReverseSort, $PartId)
    {
      $this->SiteId = $SiteId;
      $this->ListOnly = $ListOnly;
      $this->Start = $Start;
      $this->Count = $Count;
      $this->ReverseSort = $ReverseSort;
      $this->PartId = $PartId;
    }

    /**
     * @return string
     */
    public function getSiteId()
    {
      return $this->SiteId;
    }

    /**
     * @param string $SiteId
     * @return \Visual\InventoryService\GetPartList
     */
    public function setSiteId($SiteId)
    {
      $this->SiteId = $SiteId;
      return $this;
    }

    /**
     * @return string
     */
    public function getListOnly()
    {
      return $this->ListOnly;
    }

    /**
     * @param string $ListOnly
     * @return \Visual\InventoryService\GetPartList
     */
    public function setListOnly($ListOnly)
    {
      $this->ListOnly = $ListOnly;
      return $this;
    }

    /**
     * @return int
     */
    public function getStart()
    {
      return $this->Start;
    }

    /**
     * @param int $Start
     * @return \Visual\InventoryService\GetPartList
     */
    public function setStart($Start)
    {
      $this->Start = $Start;
      return $this;
    }

    /**
     * @return int
     */
    public function getCount()
    {
      return $this->Count;
    }

    /**
     * @param int $Count
     * @return \Visual\InventoryService\GetPartList
     */
    public function setCount($Count)
    {
      $this->Count = $Count;
      return $this;
    }

    /**
     * @return string
     */
    public function getReverseSort()
    {
      return $this->ReverseSort;
    }

    /**
     * @param string $ReverseSort
     * @return \Visual\InventoryService\GetPartList
     */
    public function setReverseSort($ReverseSort)
    {
      $this->ReverseSort = $ReverseSort;
      return $this;
    }

    /**
     * @return string
     */
    public function getPartId()
    {
      return $this->PartId;
    }

    /**
     * @param string $PartId
     * @return \Visual\InventoryService\GetPartList
     */
    public function setPartId($PartId)
    {
      $this->PartId = $PartId;
      return $this;
    }

}
