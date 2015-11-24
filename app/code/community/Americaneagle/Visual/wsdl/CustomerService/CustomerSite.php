<?php

namespace Visual\CustomerService;

class CustomerSite extends ExternalReference
{

    /**
     * @var string $SiteID
     */
    protected $SiteID = null;

    /**
     * @var string $PriorityCode
     */
    protected $PriorityCode = null;

    /**
     * @var string $WarehouseID
     */
    protected $WarehouseID = null;

    /**
     * @var string $CustomerType
     */
    protected $CustomerType = null;

    /**
     * @var float $OrderFillRate
     */
    protected $OrderFillRate = null;

    /**
     * @var string $FillRateType
     */
    protected $FillRateType = null;

    /**
     * @var float $AllocationFence
     */
    protected $AllocationFence = null;

    /**
     * @var string $CoAllocLevel
     */
    protected $CoAllocLevel = null;

    /**
     * @var string $Reallocate
     */
    protected $Reallocate = null;

    /**
     * @var string $ConsolidateOrders
     */
    protected $ConsolidateOrders = null;

    /**
     * @var string $ComplianceLabel
     */
    protected $ComplianceLabel = null;

    /**
     * @var string $AutoAllocate
     */
    protected $AutoAllocate = null;

    
    public function __construct()
    {
      parent::__construct();
    }

    /**
     * @return string
     */
    public function getSiteID()
    {
      return $this->SiteID;
    }

    /**
     * @param string $SiteID
     * @return \Visual\CustomerService\CustomerSite
     */
    public function setSiteID($SiteID)
    {
      $this->SiteID = $SiteID;
      return $this;
    }

    /**
     * @return string
     */
    public function getPriorityCode()
    {
      return $this->PriorityCode;
    }

    /**
     * @param string $PriorityCode
     * @return \Visual\CustomerService\CustomerSite
     */
    public function setPriorityCode($PriorityCode)
    {
      $this->PriorityCode = $PriorityCode;
      return $this;
    }

    /**
     * @return string
     */
    public function getWarehouseID()
    {
      return $this->WarehouseID;
    }

    /**
     * @param string $WarehouseID
     * @return \Visual\CustomerService\CustomerSite
     */
    public function setWarehouseID($WarehouseID)
    {
      $this->WarehouseID = $WarehouseID;
      return $this;
    }

    /**
     * @return string
     */
    public function getCustomerType()
    {
      return $this->CustomerType;
    }

    /**
     * @param string $CustomerType
     * @return \Visual\CustomerService\CustomerSite
     */
    public function setCustomerType($CustomerType)
    {
      $this->CustomerType = $CustomerType;
      return $this;
    }

    /**
     * @return float
     */
    public function getOrderFillRate()
    {
      return $this->OrderFillRate;
    }

    /**
     * @param float $OrderFillRate
     * @return \Visual\CustomerService\CustomerSite
     */
    public function setOrderFillRate($OrderFillRate)
    {
      $this->OrderFillRate = $OrderFillRate;
      return $this;
    }

    /**
     * @return string
     */
    public function getFillRateType()
    {
      return $this->FillRateType;
    }

    /**
     * @param string $FillRateType
     * @return \Visual\CustomerService\CustomerSite
     */
    public function setFillRateType($FillRateType)
    {
      $this->FillRateType = $FillRateType;
      return $this;
    }

    /**
     * @return float
     */
    public function getAllocationFence()
    {
      return $this->AllocationFence;
    }

    /**
     * @param float $AllocationFence
     * @return \Visual\CustomerService\CustomerSite
     */
    public function setAllocationFence($AllocationFence)
    {
      $this->AllocationFence = $AllocationFence;
      return $this;
    }

    /**
     * @return string
     */
    public function getCoAllocLevel()
    {
      return $this->CoAllocLevel;
    }

    /**
     * @param string $CoAllocLevel
     * @return \Visual\CustomerService\CustomerSite
     */
    public function setCoAllocLevel($CoAllocLevel)
    {
      $this->CoAllocLevel = $CoAllocLevel;
      return $this;
    }

    /**
     * @return string
     */
    public function getReallocate()
    {
      return $this->Reallocate;
    }

    /**
     * @param string $Reallocate
     * @return \Visual\CustomerService\CustomerSite
     */
    public function setReallocate($Reallocate)
    {
      $this->Reallocate = $Reallocate;
      return $this;
    }

    /**
     * @return string
     */
    public function getConsolidateOrders()
    {
      return $this->ConsolidateOrders;
    }

    /**
     * @param string $ConsolidateOrders
     * @return \Visual\CustomerService\CustomerSite
     */
    public function setConsolidateOrders($ConsolidateOrders)
    {
      $this->ConsolidateOrders = $ConsolidateOrders;
      return $this;
    }

    /**
     * @return string
     */
    public function getComplianceLabel()
    {
      return $this->ComplianceLabel;
    }

    /**
     * @param string $ComplianceLabel
     * @return \Visual\CustomerService\CustomerSite
     */
    public function setComplianceLabel($ComplianceLabel)
    {
      $this->ComplianceLabel = $ComplianceLabel;
      return $this;
    }

    /**
     * @return string
     */
    public function getAutoAllocate()
    {
      return $this->AutoAllocate;
    }

    /**
     * @param string $AutoAllocate
     * @return \Visual\CustomerService\CustomerSite
     */
    public function setAutoAllocate($AutoAllocate)
    {
      $this->AutoAllocate = $AutoAllocate;
      return $this;
    }

}
