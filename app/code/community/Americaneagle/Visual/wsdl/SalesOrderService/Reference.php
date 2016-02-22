<?php

namespace Visual\SalesOrderService;

class Reference
{

    /**
     * @var string $ExternalGroup
     */
    protected $ExternalGroup = null;

    /**
     * @var string $ExternalType
     */
    protected $ExternalType = null;

    /**
     * @var string $ExternalID
     */
    protected $ExternalID = null;

    /**
     * @var string $ExternalLineNo
     */
    protected $ExternalLineNo = null;

    /**
     * @var string $SourceType
     */
    protected $SourceType = null;

    /**
     * @var string $ID
     */
    protected $ID = null;

    /**
     * @var string $LineNo
     */
    protected $LineNo = null;

    /**
     * @var boolean $Dirty
     */
    protected $Dirty = null;

    /**
     * @var \DateTime $CreateDate
     */
    protected $CreateDate = null;

    /**
     * @var string $CreateUser
     */
    protected $CreateUser = null;

    /**
     * @var \DateTime $ModifyDate
     */
    protected $ModifyDate = null;

    /**
     * @var string $ModifyUser
     */
    protected $ModifyUser = null;

    /**
     * @var boolean $Conflicted
     */
    protected $Conflicted = null;

    /**
     * @param boolean $Dirty
     * @param \DateTime $CreateDate
     * @param boolean $Conflicted
     */
    public function __construct($Dirty, \DateTime $CreateDate, $Conflicted)
    {
      $this->Dirty = $Dirty;
      $this->CreateDate = $CreateDate->format(\DateTime::ATOM);
      $this->Conflicted = $Conflicted;
    }

    /**
     * @return string
     */
    public function getExternalGroup()
    {
      return $this->ExternalGroup;
    }

    /**
     * @param string $ExternalGroup
     * @return \Visual\SalesOrderService\Reference
     */
    public function setExternalGroup($ExternalGroup)
    {
      $this->ExternalGroup = $ExternalGroup;
      return $this;
    }

    /**
     * @return string
     */
    public function getExternalType()
    {
      return $this->ExternalType;
    }

    /**
     * @param string $ExternalType
     * @return \Visual\SalesOrderService\Reference
     */
    public function setExternalType($ExternalType)
    {
      $this->ExternalType = $ExternalType;
      return $this;
    }

    /**
     * @return string
     */
    public function getExternalID()
    {
      return $this->ExternalID;
    }

    /**
     * @param string $ExternalID
     * @return \Visual\SalesOrderService\Reference
     */
    public function setExternalID($ExternalID)
    {
      $this->ExternalID = $ExternalID;
      return $this;
    }

    /**
     * @return string
     */
    public function getExternalLineNo()
    {
      return $this->ExternalLineNo;
    }

    /**
     * @param string $ExternalLineNo
     * @return \Visual\SalesOrderService\Reference
     */
    public function setExternalLineNo($ExternalLineNo)
    {
      $this->ExternalLineNo = $ExternalLineNo;
      return $this;
    }

    /**
     * @return string
     */
    public function getSourceType()
    {
      return $this->SourceType;
    }

    /**
     * @param string $SourceType
     * @return \Visual\SalesOrderService\Reference
     */
    public function setSourceType($SourceType)
    {
      $this->SourceType = $SourceType;
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
     * @return \Visual\SalesOrderService\Reference
     */
    public function setID($ID)
    {
      $this->ID = $ID;
      return $this;
    }

    /**
     * @return string
     */
    public function getLineNo()
    {
      return $this->LineNo;
    }

    /**
     * @param string $LineNo
     * @return \Visual\SalesOrderService\Reference
     */
    public function setLineNo($LineNo)
    {
      $this->LineNo = $LineNo;
      return $this;
    }

    /**
     * @return boolean
     */
    public function getDirty()
    {
      return $this->Dirty;
    }

    /**
     * @param boolean $Dirty
     * @return \Visual\SalesOrderService\Reference
     */
    public function setDirty($Dirty)
    {
      $this->Dirty = $Dirty;
      return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreateDate()
    {
      if ($this->CreateDate == null) {
        return null;
      } else {
        try {
          return new \DateTime($this->CreateDate);
        } catch (\Exception $e) {
          return false;
        }
      }
    }

    /**
     * @param \DateTime $CreateDate
     * @return \Visual\SalesOrderService\Reference
     */
    public function setCreateDate(\DateTime $CreateDate)
    {
      $this->CreateDate = $CreateDate->format(\DateTime::ATOM);
      return $this;
    }

    /**
     * @return string
     */
    public function getCreateUser()
    {
      return $this->CreateUser;
    }

    /**
     * @param string $CreateUser
     * @return \Visual\SalesOrderService\Reference
     */
    public function setCreateUser($CreateUser)
    {
      $this->CreateUser = $CreateUser;
      return $this;
    }

    /**
     * @return \DateTime
     */
    public function getModifyDate()
    {
      if ($this->ModifyDate == null) {
        return null;
      } else {
        try {
          return new \DateTime($this->ModifyDate);
        } catch (\Exception $e) {
          return false;
        }
      }
    }

    /**
     * @param \DateTime $ModifyDate
     * @return \Visual\SalesOrderService\Reference
     */
    public function setModifyDate(\DateTime $ModifyDate = null)
    {
      if ($ModifyDate == null) {
       $this->ModifyDate = null;
      } else {
        $this->ModifyDate = $ModifyDate->format(\DateTime::ATOM);
      }
      return $this;
    }

    /**
     * @return string
     */
    public function getModifyUser()
    {
      return $this->ModifyUser;
    }

    /**
     * @param string $ModifyUser
     * @return \Visual\SalesOrderService\Reference
     */
    public function setModifyUser($ModifyUser)
    {
      $this->ModifyUser = $ModifyUser;
      return $this;
    }

    /**
     * @return boolean
     */
    public function getConflicted()
    {
      return $this->Conflicted;
    }

    /**
     * @param boolean $Conflicted
     * @return \Visual\SalesOrderService\Reference
     */
    public function setConflicted($Conflicted)
    {
      $this->Conflicted = $Conflicted;
      return $this;
    }

}
