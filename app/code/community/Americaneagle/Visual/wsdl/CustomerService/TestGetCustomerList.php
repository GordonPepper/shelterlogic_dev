<?php

namespace Visual\CustomerService;

class TestGetCustomerList
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
     * @param string $key
     * @param string $userName
     * @param string $password
     * @param string $SiteId
     * @param string $ListOnly
     * @param string $Start
     * @param string $Count
     * @param string $ReverseSort
     * @param string $CustomerId
     * @param string $Modified
     * @param string $StartDate
     * @param string $EndDate
     * @param string $ActiveFlag
     * @param string $Territory
     * @param string $MarketId
     */
    public function __construct($key, $userName, $password, $SiteId, $ListOnly, $Start, $Count, $ReverseSort, $CustomerId, $Modified, $StartDate, $EndDate, $ActiveFlag, $Territory, $MarketId)
    {
      $this->key = $key;
      $this->userName = $userName;
      $this->password = $password;
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
    public function getKey()
    {
      return $this->key;
    }

    /**
     * @param string $key
     * @return \Visual\CustomerService\TestGetCustomerList
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
     * @return \Visual\CustomerService\TestGetCustomerList
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
     * @return \Visual\CustomerService\TestGetCustomerList
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
     * @return \Visual\CustomerService\TestGetCustomerList
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
     * @return \Visual\CustomerService\TestGetCustomerList
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
     * @return \Visual\CustomerService\TestGetCustomerList
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
     * @return \Visual\CustomerService\TestGetCustomerList
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
     * @return \Visual\CustomerService\TestGetCustomerList
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
     * @return \Visual\CustomerService\TestGetCustomerList
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
     * @return \Visual\CustomerService\TestGetCustomerList
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
     * @return \Visual\CustomerService\TestGetCustomerList
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
     * @return \Visual\CustomerService\TestGetCustomerList
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
     * @return \Visual\CustomerService\TestGetCustomerList
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
     * @return \Visual\CustomerService\TestGetCustomerList
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
     * @return \Visual\CustomerService\TestGetCustomerList
     */
    public function setMarketId($MarketId)
    {
      $this->MarketId = $MarketId;
      return $this;
    }

}
