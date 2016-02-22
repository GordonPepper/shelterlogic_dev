<?php

namespace Visual\InventoryService;

class BaseDataResponse
{

    /**
     * @var boolean $HasErrors
     */
    protected $HasErrors = null;

    /**
     * @var string $UserID
     */
    protected $UserID = null;

    /**
     * @var string $Database
     */
    protected $Database = null;

    /**
     * @var \DateTime $SubmitDateTime
     */
    protected $SubmitDateTime = null;

    /**
     * @var \DateTime $ResponseDateTime
     */
    protected $ResponseDateTime = null;

    /**
     * @param boolean $HasErrors
     * @param \DateTime $SubmitDateTime
     * @param \DateTime $ResponseDateTime
     */
    public function __construct($HasErrors, \DateTime $SubmitDateTime, \DateTime $ResponseDateTime)
    {
      $this->HasErrors = $HasErrors;
      $this->SubmitDateTime = $SubmitDateTime->format(\DateTime::ATOM);
      $this->ResponseDateTime = $ResponseDateTime->format(\DateTime::ATOM);
    }

    /**
     * @return boolean
     */
    public function getHasErrors()
    {
      return $this->HasErrors;
    }

    /**
     * @param boolean $HasErrors
     * @return \Visual\InventoryService\BaseDataResponse
     */
    public function setHasErrors($HasErrors)
    {
      $this->HasErrors = $HasErrors;
      return $this;
    }

    /**
     * @return string
     */
    public function getUserID()
    {
      return $this->UserID;
    }

    /**
     * @param string $UserID
     * @return \Visual\InventoryService\BaseDataResponse
     */
    public function setUserID($UserID)
    {
      $this->UserID = $UserID;
      return $this;
    }

    /**
     * @return string
     */
    public function getDatabase()
    {
      return $this->Database;
    }

    /**
     * @param string $Database
     * @return \Visual\InventoryService\BaseDataResponse
     */
    public function setDatabase($Database)
    {
      $this->Database = $Database;
      return $this;
    }

    /**
     * @return \DateTime
     */
    public function getSubmitDateTime()
    {
      if ($this->SubmitDateTime == null) {
        return null;
      } else {
        try {
          return new \DateTime($this->SubmitDateTime);
        } catch (\Exception $e) {
          return false;
        }
      }
    }

    /**
     * @param \DateTime $SubmitDateTime
     * @return \Visual\InventoryService\BaseDataResponse
     */
    public function setSubmitDateTime(\DateTime $SubmitDateTime)
    {
      $this->SubmitDateTime = $SubmitDateTime->format(\DateTime::ATOM);
      return $this;
    }

    /**
     * @return \DateTime
     */
    public function getResponseDateTime()
    {
      if ($this->ResponseDateTime == null) {
        return null;
      } else {
        try {
          return new \DateTime($this->ResponseDateTime);
        } catch (\Exception $e) {
          return false;
        }
      }
    }

    /**
     * @param \DateTime $ResponseDateTime
     * @return \Visual\InventoryService\BaseDataResponse
     */
    public function setResponseDateTime(\DateTime $ResponseDateTime)
    {
      $this->ResponseDateTime = $ResponseDateTime->format(\DateTime::ATOM);
      return $this;
    }

}
