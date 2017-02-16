<?php

namespace Visual\InventoryService;

class TestGetPartList
{

    /**
     * @var string $key
     */
    protected $key = null;

    /**
     * @var string $userName
     */
    protected $userName = null;

    /**
     * @var string $password
     */
    protected $password = null;

    /**
     * @var string $SiteId
     */
    protected $SiteId = null;

    /**
     * @var string $ListOnly
     */
    protected $ListOnly = null;

    /**
     * @var string $Start
     */
    protected $Start = null;

    /**
     * @var string $Count
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
     * @param string $key
     * @param string $userName
     * @param string $password
     * @param string $SiteId
     * @param string $ListOnly
     * @param string $Start
     * @param string $Count
     * @param string $ReverseSort
     * @param string $PartId
     */
    public function __construct($key, $userName, $password, $SiteId, $ListOnly, $Start, $Count, $ReverseSort, $PartId)
    {
      $this->key = $key;
      $this->userName = $userName;
      $this->password = $password;
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
    public function getKey()
    {
      return $this->key;
    }

    /**
     * @param string $key
     * @return \Visual\InventoryService\TestGetPartList
     */
    public function setKey($key)
    {
      $this->key = $key;
      return $this;
    }

    /**
     * @return string
     */
    public function getUserName()
    {
      return $this->userName;
    }

    /**
     * @param string $userName
     * @return \Visual\InventoryService\TestGetPartList
     */
    public function setUserName($userName)
    {
      $this->userName = $userName;
      return $this;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
      return $this->password;
    }

    /**
     * @param string $password
     * @return \Visual\InventoryService\TestGetPartList
     */
    public function setPassword($password)
    {
      $this->password = $password;
      return $this;
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
     * @return \Visual\InventoryService\TestGetPartList
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
     * @return \Visual\InventoryService\TestGetPartList
     */
    public function setListOnly($ListOnly)
    {
      $this->ListOnly = $ListOnly;
      return $this;
    }

    /**
     * @return string
     */
    public function getStart()
    {
      return $this->Start;
    }

    /**
     * @param string $Start
     * @return \Visual\InventoryService\TestGetPartList
     */
    public function setStart($Start)
    {
      $this->Start = $Start;
      return $this;
    }

    /**
     * @return string
     */
    public function getCount()
    {
      return $this->Count;
    }

    /**
     * @param string $Count
     * @return \Visual\InventoryService\TestGetPartList
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
     * @return \Visual\InventoryService\TestGetPartList
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
     * @return \Visual\InventoryService\TestGetPartList
     */
    public function setPartId($PartId)
    {
      $this->PartId = $PartId;
      return $this;
    }

}
