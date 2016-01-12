<?php

namespace Visual\CustomerService;

class GetCustomerList
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
     * @var string $CustomerId
     */
    protected $CustomerId = null;

    /**
     * @var string $Modified
     */
    protected $Modified = null;

    /**
     * @var string $StartDate
     */
    protected $StartDate = null;

    /**
     * @var string $EndDate
     */
    protected $EndDate = null;

    /**
     * @var string $ActiveFlag
     */
    protected $ActiveFlag = null;

    /**
     * @var string $Territory
     */
    protected $Territory = null;

    /**
     * @var string $MarketId
     */
    protected $MarketId = null;

    /**
     * @param string $SiteId
     * @param string $ListOnly
     * @param int $Start
     * @param int $Count
     * @param string $ReverseSort
     * @param string $CustomerId
     * @param string $Modified
     * @param string $StartDate
     * @param string $EndDate
     * @param string $ActiveFlag
     * @param string $Territory
     * @param string $MarketId
     */
    public function __construct($SiteId, $ListOnly, $Start, $Count, $ReverseSort, $CustomerId, $Modified, $StartDate, $EndDate, $ActiveFlag, $Territory, $MarketId)
    {
      $this->SiteId = $SiteId;
      $this->ListOnly = $ListOnly;
      $this->Start = $Start;
      $this->Count = $Count;
      $this->ReverseSort = $ReverseSort;
      $this->CustomerId = $CustomerId;
      $this->Modified = $Modified;
      $this->StartDate = $StartDate;
      $this->EndDate = $EndDate;
      $this->ActiveFlag = $ActiveFlag;
      $this->Territory = $Territory;
      $this->MarketId = $MarketId;
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
     * @return \Visual\CustomerService\GetCustomerList
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
     * @return \Visual\CustomerService\GetCustomerList
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
     * @return \Visual\CustomerService\GetCustomerList
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
     * @return \Visual\CustomerService\GetCustomerList
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
     * @return \Visual\CustomerService\GetCustomerList
     */
    public function setReverseSort($ReverseSort)
    {
      $this->ReverseSort = $ReverseSort;
      return $this;
    }

    /**
     * @return string
     */
    public function getCustomerId()
    {
      return $this->CustomerId;
    }

    /**
     * @param string $CustomerId
     * @return \Visual\CustomerService\GetCustomerList
     */
    public function setCustomerId($CustomerId)
    {
      $this->CustomerId = $CustomerId;
      return $this;
    }

    /**
     * @return string
     */
    public function getModified()
    {
      return $this->Modified;
    }

    /**
     * @param string $Modified
     * @return \Visual\CustomerService\GetCustomerList
     */
    public function setModified($Modified)
    {
      $this->Modified = $Modified;
      return $this;
    }

    /**
     * @return string
     */
    public function getStartDate()
    {
      return $this->StartDate;
    }

    /**
     * @param string $StartDate
     * @return \Visual\CustomerService\GetCustomerList
     */
    public function setStartDate($StartDate)
    {
      $this->StartDate = $StartDate;
      return $this;
    }

    /**
     * @return string
     */
    public function getEndDate()
    {
      return $this->EndDate;
    }

    /**
     * @param string $EndDate
     * @return \Visual\CustomerService\GetCustomerList
     */
    public function setEndDate($EndDate)
    {
      $this->EndDate = $EndDate;
      return $this;
    }

    /**
     * @return string
     */
    public function getActiveFlag()
    {
      return $this->ActiveFlag;
    }

    /**
     * @param string $ActiveFlag
     * @return \Visual\CustomerService\GetCustomerList
     */
    public function setActiveFlag($ActiveFlag)
    {
      $this->ActiveFlag = $ActiveFlag;
      return $this;
    }

    /**
     * @return string
     */
    public function getTerritory()
    {
      return $this->Territory;
    }

    /**
     * @param string $Territory
     * @return \Visual\CustomerService\GetCustomerList
     */
    public function setTerritory($Territory)
    {
      $this->Territory = $Territory;
      return $this;
    }

    /**
     * @return string
     */
    public function getMarketId()
    {
      return $this->MarketId;
    }

    /**
     * @param string $MarketId
     * @return \Visual\CustomerService\GetCustomerList
     */
    public function setMarketId($MarketId)
    {
      $this->MarketId = $MarketId;
      return $this;
    }

}
