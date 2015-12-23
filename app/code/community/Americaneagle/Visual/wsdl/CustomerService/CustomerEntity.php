<?php

namespace Visual\CustomerService;

class CustomerEntity extends ExternalReference
{

    /**
     * @var string $EntityID
     */
    protected $EntityID = null;

    /**
     * @var string $CreditStatus
     */
    protected $CreditStatus = null;

    /**
     * @var string $CreditLimitCTLl
     */
    protected $CreditLimitCTLl = null;

    /**
     * @var float $CreditLimit
     */
    protected $CreditLimit = null;

    /**
     * @var float $RecvAgeLimit
     */
    protected $RecvAgeLimit = null;

    /**
     * @var float $TotalOpenOrders
     */
    protected $TotalOpenOrders = null;

    /**
     * @var float $TotalOpenRecv
     */
    protected $TotalOpenRecv = null;

    /**
     * @var float $OpenOrderCount
     */
    protected $OpenOrderCount = null;

    /**
     * @var float $OpenRecvCount
     */
    protected $OpenRecvCount = null;

    /**
     * @var float $CtBestLowerPct
     */
    protected $CtBestLowerPct = null;

    /**
     * @var float $CtGoodLowerPct
     */
    protected $CtGoodLowerPct = null;

    /**
     * @var float $PtDays
     */
    protected $PtDays = null;

    /**
     * @var float $PtBestLowerPct
     */
    protected $PtBestLowerPct = null;

    /**
     * @var float $PtGoodLowerPct
     */
    protected $PtGoodLowerPct = null;

    /**
     * @var string $OldestInvType
     */
    protected $OldestInvType = null;

    /**
     * @var float $TotalOpenShipped
     */
    protected $TotalOpenShipped = null;

    /**
     * @var \DateTime $OpenOldestRecv
     */
    protected $OpenOldestRecv = null;

    
    public function __construct()
    {
      parent::__construct();
    }

    /**
     * @return string
     */
    public function getEntityID()
    {
      return $this->EntityID;
    }

    /**
     * @param string $EntityID
     * @return \Visual\CustomerService\CustomerEntity
     */
    public function setEntityID($EntityID)
    {
      $this->EntityID = $EntityID;
      return $this;
    }

    /**
     * @return string
     */
    public function getCreditStatus()
    {
      return $this->CreditStatus;
    }

    /**
     * @param string $CreditStatus
     * @return \Visual\CustomerService\CustomerEntity
     */
    public function setCreditStatus($CreditStatus)
    {
      $this->CreditStatus = $CreditStatus;
      return $this;
    }

    /**
     * @return string
     */
    public function getCreditLimitCTLl()
    {
      return $this->CreditLimitCTLl;
    }

    /**
     * @param string $CreditLimitCTLl
     * @return \Visual\CustomerService\CustomerEntity
     */
    public function setCreditLimitCTLl($CreditLimitCTLl)
    {
      $this->CreditLimitCTLl = $CreditLimitCTLl;
      return $this;
    }

    /**
     * @return float
     */
    public function getCreditLimit()
    {
      return $this->CreditLimit;
    }

    /**
     * @param float $CreditLimit
     * @return \Visual\CustomerService\CustomerEntity
     */
    public function setCreditLimit($CreditLimit)
    {
      $this->CreditLimit = $CreditLimit;
      return $this;
    }

    /**
     * @return float
     */
    public function getRecvAgeLimit()
    {
      return $this->RecvAgeLimit;
    }

    /**
     * @param float $RecvAgeLimit
     * @return \Visual\CustomerService\CustomerEntity
     */
    public function setRecvAgeLimit($RecvAgeLimit)
    {
      $this->RecvAgeLimit = $RecvAgeLimit;
      return $this;
    }

    /**
     * @return float
     */
    public function getTotalOpenOrders()
    {
      return $this->TotalOpenOrders;
    }

    /**
     * @param float $TotalOpenOrders
     * @return \Visual\CustomerService\CustomerEntity
     */
    public function setTotalOpenOrders($TotalOpenOrders)
    {
      $this->TotalOpenOrders = $TotalOpenOrders;
      return $this;
    }

    /**
     * @return float
     */
    public function getTotalOpenRecv()
    {
      return $this->TotalOpenRecv;
    }

    /**
     * @param float $TotalOpenRecv
     * @return \Visual\CustomerService\CustomerEntity
     */
    public function setTotalOpenRecv($TotalOpenRecv)
    {
      $this->TotalOpenRecv = $TotalOpenRecv;
      return $this;
    }

    /**
     * @return float
     */
    public function getOpenOrderCount()
    {
      return $this->OpenOrderCount;
    }

    /**
     * @param float $OpenOrderCount
     * @return \Visual\CustomerService\CustomerEntity
     */
    public function setOpenOrderCount($OpenOrderCount)
    {
      $this->OpenOrderCount = $OpenOrderCount;
      return $this;
    }

    /**
     * @return float
     */
    public function getOpenRecvCount()
    {
      return $this->OpenRecvCount;
    }

    /**
     * @param float $OpenRecvCount
     * @return \Visual\CustomerService\CustomerEntity
     */
    public function setOpenRecvCount($OpenRecvCount)
    {
      $this->OpenRecvCount = $OpenRecvCount;
      return $this;
    }

    /**
     * @return float
     */
    public function getCtBestLowerPct()
    {
      return $this->CtBestLowerPct;
    }

    /**
     * @param float $CtBestLowerPct
     * @return \Visual\CustomerService\CustomerEntity
     */
    public function setCtBestLowerPct($CtBestLowerPct)
    {
      $this->CtBestLowerPct = $CtBestLowerPct;
      return $this;
    }

    /**
     * @return float
     */
    public function getCtGoodLowerPct()
    {
      return $this->CtGoodLowerPct;
    }

    /**
     * @param float $CtGoodLowerPct
     * @return \Visual\CustomerService\CustomerEntity
     */
    public function setCtGoodLowerPct($CtGoodLowerPct)
    {
      $this->CtGoodLowerPct = $CtGoodLowerPct;
      return $this;
    }

    /**
     * @return float
     */
    public function getPtDays()
    {
      return $this->PtDays;
    }

    /**
     * @param float $PtDays
     * @return \Visual\CustomerService\CustomerEntity
     */
    public function setPtDays($PtDays)
    {
      $this->PtDays = $PtDays;
      return $this;
    }

    /**
     * @return float
     */
    public function getPtBestLowerPct()
    {
      return $this->PtBestLowerPct;
    }

    /**
     * @param float $PtBestLowerPct
     * @return \Visual\CustomerService\CustomerEntity
     */
    public function setPtBestLowerPct($PtBestLowerPct)
    {
      $this->PtBestLowerPct = $PtBestLowerPct;
      return $this;
    }

    /**
     * @return float
     */
    public function getPtGoodLowerPct()
    {
      return $this->PtGoodLowerPct;
    }

    /**
     * @param float $PtGoodLowerPct
     * @return \Visual\CustomerService\CustomerEntity
     */
    public function setPtGoodLowerPct($PtGoodLowerPct)
    {
      $this->PtGoodLowerPct = $PtGoodLowerPct;
      return $this;
    }

    /**
     * @return string
     */
    public function getOldestInvType()
    {
      return $this->OldestInvType;
    }

    /**
     * @param string $OldestInvType
     * @return \Visual\CustomerService\CustomerEntity
     */
    public function setOldestInvType($OldestInvType)
    {
      $this->OldestInvType = $OldestInvType;
      return $this;
    }

    /**
     * @return float
     */
    public function getTotalOpenShipped()
    {
      return $this->TotalOpenShipped;
    }

    /**
     * @param float $TotalOpenShipped
     * @return \Visual\CustomerService\CustomerEntity
     */
    public function setTotalOpenShipped($TotalOpenShipped)
    {
      $this->TotalOpenShipped = $TotalOpenShipped;
      return $this;
    }

    /**
     * @return \DateTime
     */
    public function getOpenOldestRecv()
    {
      if ($this->OpenOldestRecv == null) {
        return null;
      } else {
        try {
          return new \DateTime($this->OpenOldestRecv);
        } catch (\Exception $e) {
          return false;
        }
      }
    }

    /**
     * @param \DateTime $OpenOldestRecv
     * @return \Visual\CustomerService\CustomerEntity
     */
    public function setOpenOldestRecv(\DateTime $OpenOldestRecv = null)
    {
      if ($OpenOldestRecv == null) {
       $this->OpenOldestRecv = null;
      } else {
        $this->OpenOldestRecv = $OpenOldestRecv->format(\DateTime::ATOM);
      }
      return $this;
    }

}
